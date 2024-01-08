<?php

namespace Database\Seeders;

use App\Enums\Users\Role as RoleEnum;
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
                'roles' => [
                    'users' => [
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'students' => [
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'instructors' => [
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                ],
            ],
            [
                'name' => RoleEnum::superuser->name,
                'description' => 'Super Admin',
                'roles' => [
                    'users' => [
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'students' => [
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'instructors' => [
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                ],
            ],
            [
                'name' => RoleEnum::admin->name,
                'description' => 'Admin',
                'roles' => [
                    'users' => [
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'students' => [
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                    'instructors' => [
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u,d'],
                    ],
                ],
            ],
            [
                'name' => RoleEnum::student->name,
                'description' => 'Cliente',
                'roles' => [
                    'users' => [
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u'],
                    ],
                    'students' => [
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u'],
                    ],
                ],
            ],
            [
                'name' => RoleEnum::instructor->name,
                'description' => 'Produtor',
                'roles' => [
                    'users' => [
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u'],
                    ],
                    'instructors' => [
                        'group_name' => 'Usuários',
                        'permissions' => ['c,r,v,u'],
                    ],
                ],
            ],
        ];
        foreach ($guards as $guard) {
            foreach ($rolesStructure as $role) {
                $perms = [];
                $groupName = null;
                foreach ($role['roles'] as $k => $item) {
                    $groupName = $item['group_name'];
                    $permissions = $item['permissions'];
                    $crudSign = explode(',', $permissions[0]);
                    foreach ($permissionMap as $perm => $permission) {
                        if (! in_array($perm, $crudSign)) {
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
                                    'description' => "{$value} {$groupName}",
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
                        'group_name' => $groupName,
                    ],
                ], ['name', 'guard_name']);
                $role = Role::where(['name' => $role['name'], 'guard_name' => $guard])->first();
                $role->givePermissionTo($perms);
            }
        }
    }
}
