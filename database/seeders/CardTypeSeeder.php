<?php

namespace Database\Seeders;

use App\Models\CardType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cardTypes = [
            'Mastercard',
            'Visa',
        ];

        foreach ($cardTypes as $cardType) {
            CardType::updateOrCreate(
                ['name' => $cardType],
                ['logo_path' => "/$cardType.png",]
            );
        }
    }
}
