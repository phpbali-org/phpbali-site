<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Admin::class, 5)->create();
        factory(Admin::class, 1)->create([
            'name' => 'Super Admin',
            'email' => 'admin@phpbali.com',
            'password' => bcrypt('phpbaliadmin002'),
        ]);
    }
}
