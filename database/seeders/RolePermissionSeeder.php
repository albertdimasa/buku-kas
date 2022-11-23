<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'email' => 'adm@gri.co.id',
            'username' => 'admin',
            'name' => 'admin',
            'password' => Hash::make('123456')
        ]);

        $user = User::create([
            'email' => 'dms@gri.co.id',
            'username' => 'dimas',
            'name' => 'dimas',
            'password' => Hash::make('123456')
        ]);
    }
}
