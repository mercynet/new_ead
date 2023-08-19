<?php

namespace Database\Seeders;

use App\Enums\Users\Role as RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

/**
 *
 */
class PermissionSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $guardNames = guardNames();

        // Create default permissions
        foreach ($guardNames as $guard) {
            Role::upsert([
                ['name' => RoleEnum::development->name, 'guard_name' => $guard],
                ['name' => RoleEnum::superuser->name, 'guard_name' => $guard],
                ['name' => RoleEnum::admin->name, 'guard_name' => $guard],
                ['name' => RoleEnum::student->name, 'guard_name' => $guard],
                ['name' => RoleEnum::instructor->name, 'guard_name' => $guard],
            ], ['name']);
            $studentRole = Role::where(['name' => RoleEnum::student->name])->first();

            Permission::upsert([
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'list students', 'description' => 'Listar Alunos'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'view students', 'description' => 'Visualizar Alunos'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'create students', 'description' => 'Criar Alunos'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'update students', 'description' => 'Editar Alunos'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'delete students', 'description' => 'Remover Alunos'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'list instructors', 'description' => 'Listar Instrutores'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'view instructors', 'description' => 'Visualizar Instrutores'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'create instructors', 'description' => 'Criar Instrutores'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'update instructors', 'description' => 'Editar Instrutores'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'delete instructors', 'description' => 'Remover Instrutores'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'list user-groups', 'description' => 'Listar Grupos de Usuários'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'view user-groups', 'description' => 'Listar Grupos de Usuários'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'create user-groups', 'description' => 'Listar Grupos de Usuários'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'update user-groups', 'description' => 'Listar Grupos de Usuários'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'delete user-groups', 'description' => 'Listar Grupos de Usuários'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'list addresses', 'description' => 'Listar Endereços'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'view addresses', 'description' => 'Listar Endereços'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'create addresses', 'description' => 'Listar Endereços'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'update addresses', 'description' => 'Listar Endereços'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'delete addresses', 'description' => 'Listar Endereços'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'list any orders', 'description' => 'Listar Todas as Compras'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'list orders', 'description' => 'Listar Suas Compras'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'view orders', 'description' => 'Visualizar Compras'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'create orders', 'description' => 'Criar Compras'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'update orders', 'description' => 'Editar Compras'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'pay orders', 'description' => 'Pagar Compras'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'pay any orders', 'description' => 'Pagar quaisquer Compras'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'cancel orders', 'description' => 'Cancelar Compras'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'refund orders', 'description' => 'Devolver Compras'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'discount orders', 'description' => 'Conceder Descontos'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'cancel your items', 'description' => 'Cancelar itens das suas vendas'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'cancel other items', 'description' => 'Cancelar itens das vendas de outros'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'list payment-modes', 'description' => 'Listar Formas de Pagamento'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'view payment-modes', 'description' => 'Visualizar Formas de Pagamento'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'create payment-modes', 'description' => 'Criar Formas de Pagamento'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'update payment-modes', 'description' => 'Editar Formas de Pagamento'],
                ['guard_name' => $guard, 'group' => 'Compras', 'name' => 'delete payment-modes', 'description' => 'Remover Formas de Pagamento'],
                ['guard_name' => $guard, 'group' => 'Promotional', 'name' => 'list discount rules', 'description' => 'Listar Regras de Desconto'],
                ['guard_name' => $guard, 'group' => 'Promotional', 'name' => 'view discount rules', 'description' => 'Visualizar Regras de Desconto'],
                ['guard_name' => $guard, 'group' => 'Promotional', 'name' => 'create discount rules', 'description' => 'Criar Regras de Desconto'],
                ['guard_name' => $guard, 'group' => 'Promotional', 'name' => 'update discount rules', 'description' => 'Editar Regras de Desconto'],
                ['guard_name' => $guard, 'group' => 'Promotional', 'name' => 'delete discount rules', 'description' => 'Remover Regras de Desconto'],
                ['guard_name' => $guard, 'group' => 'Promotional', 'name' => 'list coupons', 'description' => 'Listar Cupons de desconto'],
                ['guard_name' => $guard, 'group' => 'Promotional', 'name' => 'view coupons', 'description' => 'Visualizar Cupons de desconto'],
                ['guard_name' => $guard, 'group' => 'Promotional', 'name' => 'create coupons', 'description' => 'Criar Cupons de desconto'],
                ['guard_name' => $guard, 'group' => 'Promotional', 'name' => 'update coupons', 'description' => 'Editar Cupons de desconto'],
                ['guard_name' => $guard, 'group' => 'Promotional', 'name' => 'delete coupons', 'description' => 'Remover Cupons de desconto'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'list courses', 'description' => 'Listar Cursos'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'view courses', 'description' => 'Visualizar Cursos'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'create courses', 'description' => 'Criar Cursos'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'update courses', 'description' => 'Editar Cursos'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'delete courses', 'description' => 'Remover Cursos'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'list courses modules', 'description' => 'Listar Módulos de Cursos'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'view courses modules', 'description' => 'Visualizar Módulos de Cursos'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'create courses modules', 'description' => 'Criar Módulos de Cursos'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'update courses modules', 'description' => 'Editar Módulos de Cursos'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'delete courses modules', 'description' => 'Remover Módulos de Cursos'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'list lessons', 'description' => 'Listar Aulas'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'view lessons', 'description' => 'Visualizar Aulas'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'create lessons', 'description' => 'Criar Aulas'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'update lessons', 'description' => 'Editar Aulas'],
                ['guard_name' => $guard, 'group' => 'Courses', 'name' => 'delete lessons', 'description' => 'Remover Aulas'],
                ['guard_name' => $guard, 'group' => 'Quizzes', 'name' => 'list quizzes', 'description' => 'Listar Questionários'],
                ['guard_name' => $guard, 'group' => 'Quizzes', 'name' => 'view quizzes', 'description' => 'Visualizar Questionários'],
                ['guard_name' => $guard, 'group' => 'Quizzes', 'name' => 'create quizzes', 'description' => 'Criar Questionários'],
                ['guard_name' => $guard, 'group' => 'Quizzes', 'name' => 'update quizzes', 'description' => 'Editar Questionários'],
                ['guard_name' => $guard, 'group' => 'Quizzes', 'name' => 'delete quizzes', 'description' => 'Remover Questionários'],
                ['guard_name' => $guard, 'group' => 'Quizzes', 'name' => 'list quizzes results', 'description' => 'Listar Resultados de Questionários'],
            ], ['group_name', 'name']);
            // Create user role and assign existing permissions
            $currentPermissions = Permission::where(['guard_name' => $guard])->get();
            $studentRole->syncPermissions($currentPermissions);
        }

        // Create admin exclusive permissions
        foreach ($guardNames as $guard) {
            Permission::upsert([
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'list roles', 'description' => 'Listar Perfis de Usuário'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'view roles', 'description' => 'Visualizar Perfis de Usuário'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'create roles', 'description' => 'Criar Perfis de Usuário'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'update roles', 'description' => 'Editar Perfis de Usuário'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'delete roles', 'description' => 'Remover Perfis de Usuário'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'list permissions', 'description' => 'Listar Permissões'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'view permissions', 'description' => 'Visualizar Permissões'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'list administrators', 'description' => 'Listar Administradores'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'view administrators', 'description' => 'Visualizar Administradores'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'create administrators', 'description' => 'Criar Administradores'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'update administrators', 'description' => 'Editar Administradores'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'delete administrators', 'description' => 'Remover Administradores'],
            ], ['group_name', 'name']);
            // Create admin role and assign all permissions
            $allPermissions = Permission::where(['guard_name' => $guard])->get();
            $adminRole = Role::where(['name' => RoleEnum::superuser->name])->first();
            $developmentRole = Role::where(['name' => RoleEnum::development->name])->first();

            $adminRole->syncPermissions($allPermissions);
            $developmentRole->syncPermissions($allPermissions);
        }
        $user = User::whereEmail('admin@example.com')->first();
        $user?->assignRole(Role::where(['name' => RoleEnum::superuser->name])->get());
        $userDevelopment = User::whereEmail('development@craftsys.com.br')->first();
        $userDevelopment?->assignRole(Role::where(['name' => RoleEnum::development->name])->get());
    }
}
