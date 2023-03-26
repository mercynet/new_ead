<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

/**
 *
 */
class PermissionsSeeder extends Seeder
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
            $userRole = Role::create(['name' => 'user', 'guard_name' => $guard]);
            $userRole->syncPermissions($currentPermissions);
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
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'list users', 'description' => 'Listar Usuários'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'view users', 'description' => 'Visualizar Usuários'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'create users', 'description' => 'Criar Usuários'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'update users', 'description' => 'Editar Usuários'],
                ['guard_name' => $guard, 'group' => 'Usuários', 'name' => 'delete users', 'description' => 'Remover Usuários'],
            ], ['group_name', 'name']);
            // Create admin role and assign all permissions
            $allPermissions = Permission::where(['guard_name' => $guard])->get();
            $adminRole = Role::create(['name' => 'super-admin', 'guard_name' => $guard]);
            $adminRole->syncPermissions($allPermissions);
        }
        $user = User::whereEmail('admin@example.com')->first();
        $user?->assignRole(Role::where(['name' => 'super-admin'])->get());
    }
}
