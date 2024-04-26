<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['name' => 'US Dollar', 'symbol' => '$', 'abbreviation' => 'USD'],
            ['name' => 'British Pound', 'symbol' => '£', 'abbreviation' => 'GBP'],
            ['name' => 'Euro', 'symbol' => '€', 'abbreviation' => 'EUR'],
        ];

        foreach ($currencies as $currencyData) {
            Currency::updateOrCreate($currencyData);
        }
    }
}
