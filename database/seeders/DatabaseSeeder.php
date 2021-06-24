<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECK = 0');
        // \App\Models\User::factory(10)->create();
        if ($this->command->confirm('Hello Developer, Do you want refresh the database?', true)) {
            $this->command->call('migrate:refresh');
            $this->command->info('Awesome! Database was refreshed');
        }
        $this->call([
            UserTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            TranscationsTableSeeder::class,
        ]);

    }
}
