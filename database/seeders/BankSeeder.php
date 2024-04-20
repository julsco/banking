<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            'Nationwide',
            'First Direct',
            'Monzo',
        ];

        foreach ($banks as $bank) {
            Bank::updateOrCreate(
                ['name' => $bank],
                ['logo_path' => "/$bank.png",]
            );
        }
    }
}
