<?php

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert(array(
            'name' => 'Admin',
            'email' => 'admin@localhost',
            'password' => Hash::make('12300'),
        ));
    }
}
