<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Otoniel Oliveira',
            'email' => 'otonielloliveira@gmail.com',
            'password' =>  app('hash')->make('22039696'),
        ]);
    }
}
