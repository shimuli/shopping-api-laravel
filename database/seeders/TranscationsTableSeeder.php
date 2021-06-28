<?php

namespace Database\Seeders;

use App\Models\Transactions;
use Illuminate\Database\Seeder;

class TranscationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Transactions::factory()->times(2000)->create();
    }
}
