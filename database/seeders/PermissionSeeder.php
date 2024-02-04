<?php

namespace Database\Seeders;

use App\Enums\Users\Role as RoleEnum;
use App\Enums\Users\RoleGroup;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $guards = ['api', 'web'];
        $permissionMap = [
            'c' => ['create' => 'Criar'],
            'r' => ['list' => 'Listar'],
            'u' => ['update' => 'Editar'],
            'd' => ['delete' => 'Remover'],
            'e' => ['export' => 'Exportar'],
            'v' => ['view' => 'Ver'],
            'cn' => ['cancel' => 'Cancelar'],
            'a' => ['authenticate' => 'Logar como'],
            'dw' => ['download' => 'Descarregar'],
        ];
        $rolesStructure = [
            [
                'name' => RoleEnum::development->name,
                'description' => 'Development',
                'group_name' => RoleGroup::development->label(),
                'roles' => [
                    'users' => [
                        'name' => 'Usuários',
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'group_users' => [
                        'name' => 'Grupos de Usuários',
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'students' => [
                        'name' => 'Estudantes',
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'instructors' => [
                        'name' => 'Instrutores',
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'addresses' => [
                        'name' => 'Endereços',
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'phone_numbers' => [
                        'name' => 'Telefones',
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'roles' => [
                        'name' => 'Funções',
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'development' => [
                        'name' => 'Funções de Desenvolvedores',
                        'group_name' => RoleGroup::development->name,
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'settings' => [
                        'name' => 'Configurações',
                        'group_name' => 'Configurações',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                ],
            ],
        ];
        foreach ($guards as $guard) {
            foreach ($rolesStructure as $role) {
                $perms = [];
                foreach ($role['roles'] as $k => $item) {
                    $name = $item['name'];
                    $groupName = $item['group_name'];
                    $permissions = $item['permissions'];
                    $crudSign = explode(',', $permissions[0]);
                    foreach ($permissionMap as $perm => $permission) {
                        if (!in_array($perm, $crudSign)) {
                            continue;
                        }
                        foreach ($permission as $p => $value) {
                            $namePattern = "{$p}_{$k}";
                            $perms[] = $namePattern;
                            Permission::upsert([
                                [
                                    'name' => $namePattern,
                                    'group_name' => $groupName,
                                    'guard_name' => $guard,
                                    'description' => "{$value} {$name}",
                                ],
                            ], ['name', 'guard_name']);
                        }
                    }
                }
                Role::upsert([
                    [
                        'name' => $role['name'],
                        'description' => $role['description'],
                        'guard_name' => $guard,
                        'group_name' => $role['group_name'],
                    ],
                ], ['name', 'guard_name']);
                $role = Role::where(['name' => $role['name'], 'guard_name' => $guard])->first();
                $role->givePermissionTo($perms);
            }
        }
    }
}
