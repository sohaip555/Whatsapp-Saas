<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $moderatorRole = Role::firstOrCreate(['name' => 'moderator', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        $superAdminRole->givePermissionTo(Permission::all());

        $adminPermissions = [
            'view_any_user', 'view_user', 'create_user', 'update_user', 'delete_user',
            'view_any_message', 'view_message', 'create_message', 'update_message', 'delete_message',
            'view_any_subscription', 'view_subscription', 'create_subscription', 'update_subscription', 'delete_subscription',
            'view_roles',
            'view_any_roles',
        ];
        $adminRole->syncPermissions(Permission::whereIn('name', $adminPermissions)->get());

        $moderatorPermissions = [
            'view_any_message', 'view_message', 'update_message',
        ];
        $moderatorRole->syncPermissions(Permission::whereIn('name', $moderatorPermissions)->get());

        $adminUser = User::find(1);
        if ($adminUser) {
            $adminUser->assignRole('super_admin');
        }
    }
}
