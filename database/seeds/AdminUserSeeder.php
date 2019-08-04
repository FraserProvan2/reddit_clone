<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'red',
            'email' => 'clone@reddit.com',
            'password' => bcrypt('admin'),
            'email_verified_at' => now(),
        ]);
    }
}
