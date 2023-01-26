<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
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
        $user = User::create([
            'name' => 'dima',
            'email' => 'samartsew@gmail.com',
            'password' => Hash::make('adminadmin'),
        ]);
        $adminRole = Role::create(['name' => 'admin']);
        $user->assignRole($adminRole);
    }
}
