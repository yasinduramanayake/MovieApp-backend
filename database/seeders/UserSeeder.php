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
        Excel::import(new UsersImport(), 'users.xlsx');
    }
}