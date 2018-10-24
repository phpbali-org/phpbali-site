<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function tables()
    {
        return collect(json_decode(json_encode(DB::select('SHOW TABLES')), true))
            ->map(function ($item) {
                return array_values($item)[0];
            })->filter(function ($item) {
                return $item != 'migrations';
            });
    }

    protected function truncateTables()
    {
        Schema::disableForeignKeyConstraints();
        foreach ($this->tables() as $table) {
            DB::table($table)->truncate();
            $this->command->info("Truncated: {$table}");
        }
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('production')) {
            exit('I just stopped you getting fired.');
        }

        $this->truncateTables();

        $this->call(UsersSeeder::class);
        $this->call(AdminsSeeder::class);
        $this->call(EventsSeeder::class);
    }
}
