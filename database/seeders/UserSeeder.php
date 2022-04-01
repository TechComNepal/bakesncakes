<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name'=>'Super Admin',
                'username'=>'Superadmin',
                'email'=>'superadmin@example.com',
                'password'=>Hash::make('superadmin'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=>'Admin',
                'username'=>'Admin',
                'email'=>'admin@example.com',
                'password'=>Hash::make('admin'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=>'Employee',
                'username'=>'Employee',
                'email'=>'employee@example.com',
                'password'=>Hash::make('employee'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=>'Vendor',
                'username'=>'Vendor',
                'email'=>'vendor@example.com',
                'password'=>Hash::make('vendor'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'username' => 'User',
                'email' => 'user@example.com',
                'password' => Hash::make('user'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        $superadmin=User::where('name', 'Super Admin')->first();
        $superadmin->assignRole('superadmin');

        $admin=User::where('name', 'Admin')->first();
        $admin->assignRole('admin');

        $employee=User::where('name', 'Employee')->first();
        $employee->assignRole('employee');

        $vendor=User::where('name', 'Vendor')->first();
        $vendor->assignRole('vendor');

        $user=User::where('name', 'User')->first();
        $user->assignRole('user');
    }
}
