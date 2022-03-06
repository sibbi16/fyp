<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('TRUNCATE_ON_SEED')) {
            Schema::disableForeignKeyConstraints();
            User::truncate();
            Schema::enableForeignKeyConstraints();

        }
        $users = [
            [
                'fname' => 'Administrator',
                'lname' => 'Testing',
                'email' => 'admin@mail.com',
                'phone' => '03155035206',
                'address' => 'house # 7D',
                'password' => Hash::make('123456789'),
                'role' => 'admin',
            ],
            [
                'fname' => 'Company',
                'lname' => 'Testing',
                'email' => 'company@mail.com',
                'phone' => '03355035206',
                'address' => 'house # 2D',
                'company_address'=> 'testing address for company',
                'company_phone'=> '0516739887',
                'type' => '1',
                'password' => Hash::make('123456789'),
                'role' => 'company',
            ],
            [
                'fname' => 'individual',
                'lname' => 'Testing',
                'email' => 'individual@mail.com',
                'phone' => '03155035206',
                'address' => 'house # 10D',
                'type' => '2',
                'password' => Hash::make('123456789'),
            ],
            [
                'fname' => 'Shop Keeper',
                'lname' => 'Testing',
                'email' => 'shopkeeper@mail.com',
                'phone' => '03155035206',
                'address' => 'house # 10D',
                'type' => '3',
                'password' => Hash::make('123456789'),
            ],
        ];
        foreach ($users as $user) {
            $user_role = $user['role'] ?? 'individual';
            unset($user['role']);

            $new_user = User::create($user);
            $new_user->assignRole($user_role);
        }
    }
}