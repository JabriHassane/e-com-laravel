<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'name'=>'Roben Houd',
            'email'=>'roben@kilua.com',
            'password'=>Hash::make('12345')
            ],
            [
                'name'=>'Killua',
                'email'=>'killua@kilua.com',
                'password'=>Hash::make('1234')
            ],
            [
                'name'=>'test 0',
                'email'=>'test@test.com',
                'password'=>Hash::make('12345')
            ],
        ]);
    }
}
