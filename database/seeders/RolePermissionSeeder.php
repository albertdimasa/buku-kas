<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            'password' => Hash::make('admin')
        ]);

        $user = User::create([
            'email' => 'dms@gri.co.id',
            'username' => 'dimas',
            'name' => 'dimas',
            'password' => Hash::make('dimas')
        ]);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $admin->assignRole('admin');
        $user->assignRole('user');
    }
}
