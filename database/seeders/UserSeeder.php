<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kamal Perera',
            'email' => 'kamalperera123@gmail.com',
            'password' => bcrypt('Kamal123#'),
            'mobile' => '0713790125',
            'role' => 'Admin',
        ]);
    }
}