<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // disable events
        User::flushEventListeners();
        // Categories::flushEventListeners();
        // Products::flushEventListeners();
        // Transactions::flushEventListeners();

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
