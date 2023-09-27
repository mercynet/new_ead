<?php

use App\Models\Role;
use App\Models\Users\User;
use Spatie\Permission\Models\Permission;

uses()->group('mzrt', 'users');

beforeEach(function () {
    $this->user = User::first();
    Permission::upsert([
        ['guard_name' => 'web', 'group' => 'Usuários', 'name' => 'list administrators', 'description' => 'Listar Administradores'],
        ['guard_name' => 'web', 'group' => 'Usuários', 'name' => 'view administrators', 'description' => 'Visualizar Administradores'],
        ['guard_name' => 'web', 'group' => 'Usuários', 'name' => 'create administrators', 'description' => 'Criar Administradores'],
        ['guard_name' => 'web', 'group' => 'Usuários', 'name' => 'update administrators', 'description' => 'Editar Administradores'],
        ['guard_name' => 'web', 'group' => 'Usuários', 'name' => 'delete administrators', 'description' => 'Remover Administradores'],
    ], ['group_name', 'name']);
    // Create admin role and assign all permissions
    $allPermissions = Permission::where(['guard_name' => 'web'])->get();
    $this->superuser = Role::create(['name' => 'superuser', 'guard_name' => 'web']);
    $this->superuser->syncPermissions($allPermissions);
    $this->user?->assignRole(Role::where(['name' => 'superuser'])->get());
    actingAs($this->user);
});
it('should be able to retrieve a list of all administrators users paginated by 20', function () {
    User::factory(21)->create();
    User::limit(21)->latest()->get()->each(fn($user) => $user->assignRole($this->superuser->name));

    $response = $this->getJson(route('mzrt.users.index', ['role' => [$this->superuser->name]]));

    expect($response)->assertOk()
        ->and($response->content())->toBeJson()->json()
        ->toHaveCount(4)->toHaveKeys([
            'success',
            'data',
            'meta',
            'links'
        ])
        ->success->toBeBool()->toBeTrue()
        ->data->not->toBeEmpty()
        ->toHaveCount(20)
        ->each->toHaveCount(11)
        ->toHaveKeys([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
            'active',
            'group_id',
            'roles',
            'user_info',
            'instructor',
            'group',
        ])
        ->data->each(fn($data) => $data->roles->each(fn($role) => $role->name->toBeIn([$this->superuser->name])));
});
it('should be able to retrieve a list of all students users paginated by 20', function () {
    $role = Role::create(['name' => 'student']);
    User::factory(21)->create();
    User::limit(21)->latest()->get()->each(fn($user) => $user->syncRoles([$role->name]));

    $response = $this->getJson(route('mzrt.users.index', ['role' => $role->name]));

    expect($response)->assertOk()
        ->and($response->content())->toBeJson()->json()
        ->toHaveCount(4)->toHaveKeys([
            'success',
            'data',
            'meta',
            'links'
        ])
        ->success->toBeBool()->toBeTrue()
        ->data->not->toBeEmpty()
        ->toHaveCount(20)
        ->each->toHaveCount(8)->toHaveKeys([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
            'active',
            'group_id',
            'roles',
        ])
        ->data->each(fn($data) => $data->roles->each(fn($item) => $item->name->toBeIn([$role->name])));
});
it('should be able to retrieve an user', function () {
    $user = User::factory()->create();

    $response = $this->getJson(route('mzrt.users.show', ['user' => $user->id]));

    expect($response)->assertOk()
        ->and($response->content())->not->toBeEmpty()->toBeJson()->json()
        ->toHaveCount(2)
        ->success->toBeBool()->toBeTrue()
        ->data->toHaveCount(8)->toHaveKeys([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
            'active',
            'group_id',
            'roles'
        ]);
});
it('should be able to store a new user in student role', function () {
    $name = 'Testing user';
    $email = 'testing@example.com';
    $password = 'Abcd123!@#';

    $role = Role::create(['name' => 'student']);
    $response = $this->postJson(route('mzrt.users.store'), [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password,
        'roles' => [$role->name]
    ]);

    $user = User::orderByDesc('id')->first();
    expect($response)->assertCreated()
        ->and($response->content())->toBeJson()->json()
        ->toHaveCount(2)
        ->toHaveKeys(['success', 'data'])
        ->success->toBeBool()->toBeTrue()
        ->data->name->toBe($user->name)
        ->data->email->toBe($user->email)
        ->data->roles->not->toBeEmpty()
        ->data->roles->each(fn($data) => $data->name->toBe($role->name));
});
it('should not be able to store a new user in student role by bad role', function () {
    $name = 'Testing user';
    $email = 'testing@example.com';
    $password = 'Abcd123!@#';

    $role = Role::create(['name' => 'student']);
    $response = $this->postJson(route('mzrt.users.store'), [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password,
        'roles' => [$role->name]
    ]);

    $user = User::orderByDesc('id')->first();
    expect($response)->assertCreated()
        ->and($response->content())->toBeJson()->json()
        ->toHaveCount(2)
        ->toHaveKeys(['success', 'data'])
        ->success->toBeBool()->toBeTrue()
        ->data->name->toBe($user->name)
        ->data->email->toBe($user->email)
        ->data->roles->not->toBeEmpty();
});
it('should be able to update an existing user', function () {
    $name = 'Testing user';
    $email = 'testing@example.com';
    $password = 'Abcd123!@#';

    $role = Role::create(['name' => 'student']);
    $user = User::factory()->create();

    $response = $this->putJson(route('mzrt.users.update', ['user' => $user->id]), [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password,
        'roles' => [$role->name]
    ]);

    $user = User::orderByDesc('id')->first();
    expect($response)->assertOk()
        ->and($response->content())->toBeJson()->json()
        ->toHaveCount(2)
        ->toHaveKeys(['success', 'data'])
        ->success->toBeBool()->toBeTrue()
        ->and($user)->name->toBe($name)
        ->email->toBe($email)
        ->roles->not->toBeEmpty();
});
it('should be able to remove an existing user', function () {
    User::factory(5)->create();
    $user = User::latest()->first();

    $response = $this->deleteJson(route('mzrt.users.destroy', ['user' => $user->id]));

    expect($response)->assertOk()
        ->and($response->content())->toBeJson()->json()
        ->toHaveCount(4)->toHaveKeys([
            'success',
            'data',
            'meta',
            'links'
        ])
        ->success->toBeBool()->toBeTrue()
        ->data->not->toBeEmpty()
        ->toHaveCount(5);
});
it('should be able to enable an user', function () {
    $user = User::factory()->create(['active' => false]);

    $response = $this->patchJson(route('mzrt.users.enable', ['user' => $user->id]));
    $enabledUser = User::find($user->id);

    expect($response)->assertOk()
        ->and($response->content())->toBeJson()->json()
        ->toHaveCount(2)->toHaveKeys([
            'success',
            'data',
        ])
        ->success->toBeBool()->toBeTrue()
        ->data->not->toBeEmpty()
        ->toHaveCount(8)
        ->toHaveKeys([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
            'active',
            'group_id',
        ])
        ->and($enabledUser)->active->toBeBool()->toBeTrue();
});
it('should be able to disable an user', function () {
    $user = User::factory()->create(['active' => true]);

    $response = $this->patchJson(route('mzrt.users.disable', ['user' => $user->id]));
    $disabledUser = User::find($user->id);

    expect($response)->assertOk()
        ->and($response->content())->toBeJson()->json()
        ->toHaveCount(2)->toHaveKeys([
            'success',
            'data',
        ])
        ->success->toBeBool()->toBeTrue()
        ->data->not->toBeEmpty()
        ->toHaveCount(8)
        ->toHaveKeys([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
            'active',
            'group_id',
        ])
        ->and($disabledUser)->active->toBeBool()->toBeFalse();
});
