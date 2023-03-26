<?php

use App\Models\Role;
use App\Models\User;

uses()->group('mzrt', 'users');

beforeEach(function () {
    $this->user = actingAs();
});
it('should be able to retrieve a list of all users paginated by 20', function () {
    //Arrange
    User::factory(21)->create();
    //Act
    $response = $this->getJson(route('mzrt.users.index'));
    //Assert
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
        ->each->toHaveCount(7)->toHaveKeys([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
            'active',
            'group_id',
        ]);
});
it('should be able to retrieve one user', function () {
    //Arrange
    $user = User::factory()->create();

    //Act
    $response = $this->getJson(route('mzrt.users.show', ['user' => $user->id]));

    //Assert
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
    $response = $this->postJson(route('mzrt.users.store', [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password,
        'roles' => [$role->name]
    ]));

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
//se a app atualiza as informações de um utilizador
//se a app remove um utilizador
//se a app atualiza o status de um utilizador
//se a app retorna erro ao tentar cadastrar novo utilizador por campos incompletos
//se a app retorna erro ao tentar cadastrar novo utilizador por email já existente
