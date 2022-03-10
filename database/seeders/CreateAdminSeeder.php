<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            [
                'name'=>'Admin',
                'email'=>'admin@maven.com',
                'password'=> bcrypt('admin@123'),
            ]];

        foreach ($admin as $key => $value) {
            Admin::create($value);
        }
    }
}
