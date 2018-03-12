<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();

        // User::create([
        // 	'name'	=> 'PHP',
        // 	'email'			=> 'admin@phpbali.com',
        // 	'website'		=> null,
        // 	'is_admin'		=> 1,
        // 	'password'		=> bcrypt('phpbaliadmin002'),
        // 	'remember_token' => str_random(60),
        // ]);
    }
}
