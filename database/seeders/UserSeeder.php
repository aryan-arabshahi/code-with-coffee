<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'Aryan Arabshahi',
            'email' => 'aryan.arabshahi.programmer@gmail.com',
            'password' => bcrypt('admin'),
        ]);
    }

}
