<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        if(env('TRUNCATE_ON_SEED')) {
            Schema::disableForeignKeyConstraints();
            DB::table('roles')->truncate();
            DB::table('role_has_permissions')->truncate();
            DB::table('permissions')->truncate();
            DB::table('model_has_roles')->truncate();
            DB::table('model_has_permissions')->truncate();
            Schema::enableForeignKeyConstraints();
        }
        $permissionsByRole  = [
            'admin' => [
                'view admin dashboard',
                'view student list',
                'delete user profile',

            ],

            'company' => [
               'view company dashboard',
            ],

            'individual' => [
                'view individual dashboard',
             ],

             'shopkeeper' => [
                'view shopkeeper dashboard',
             ],
        ];
        $insertPermissions = function ($role) use ($permissionsByRole) {
            return collect($permissionsByRole[$role])
                ->map(function ($name) {
                    return (Permission::findOrCreate($name))->id;
                })
                ->toArray();
        };
        $permissionIdsByRole = [
            'admin' => $insertPermissions('admin'),
            'company' => $insertPermissions('company'),
            'individual' => $insertPermissions('individual'),
            'shopkeeper' => $insertPermissions('shopkeeper'),

        ];
        foreach ($permissionIdsByRole as $role => $permissionIds) {
            $role = Role::findOrCreate($role);

            DB::table('role_has_permissions')
                ->insert(
                    collect($permissionIds)->map(function ($id) use ($role) {
                        return [
                            'role_id' => $role->id,
                            'permission_id' => $id
                        ];
                    })->toArray()
                );
        }

    }
}
