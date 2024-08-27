<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $administrator              =   new \App\Models\User;
        $administrator->name        =   'admin123';
        $administrator->email       =   'admin@example.com';
        $administrator->password    =   bcrypt('admin123');
        $administrator->save();
        $this->command->info('User Admin Berhasil Di Insert !');
    }
}
