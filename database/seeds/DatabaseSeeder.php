<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('admins')->insert([
            'name'     => 'Super Admin',
            'email'    => 'admin@phpbali.com',
            'password' => bcrypt('phpbaliadmin002'),
        ]);
    }
}
