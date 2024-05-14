<?php

namespace Database\Seeders;

use App\Enums\Permissions\ActionPermission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => ActionPermission::showProject->value]);
        Permission::create(['name' => ActionPermission::createProject->value]);
        Permission::create(['name' => ActionPermission::updateProject->value]);
        Permission::create(['name' => ActionPermission::deleteProject->value]);
        Permission::create(['name' => ActionPermission::addAvatar->value]);

        $userRole = Role::create(['name' => 'user']);
        $studentRole = Role::create(['name' => 'student']);
        $admin = Role::create(['name' => 'admin']);

        $userRole->givePermissionTo(ActionPermission::addAvatar->value);

        $studentRole->givePermissionTo(ActionPermission::showProject->value);
        $studentRole->givePermissionTo(ActionPermission::createProject->value);
        $studentRole->givePermissionTo(ActionPermission::updateProject->value);
        $studentRole->givePermissionTo(ActionPermission::deleteProject->value);

        User::factory()->create([
            'first_name' => 'User',
            'last_name' => 'Testov',
            'email' => 'user@mail.com',
            'nickname' => 'user',
            'password' => Hash::make('test'),
        ])->assignRole($userRole);

        User::factory()->create([
            'first_name' => 'Student',
            'last_name' => 'Testov',
            'email' => 'student@mail.com',
            'nickname' => 'student',
            'password' => Hash::make('test'),
        ])->assignRole($studentRole);

        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Testov',
            'nickname' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('test'),
        ])->assignRole($admin);
    }
}
