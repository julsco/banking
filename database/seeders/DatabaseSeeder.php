<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BankSeeder::class);
        $this->call(CardTypeSeeder::class);
        $this->call(PaymentCategorySeeder::class);
        $this->call(CurrencySeeder::class);
    }
}
