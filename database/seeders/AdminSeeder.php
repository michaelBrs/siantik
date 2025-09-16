<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Rio Barus',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
    
        Role::create(['name' => 'admin']);
        $admin->assignRole('admin');
    }
}
