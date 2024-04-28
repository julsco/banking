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
            ['name' => 'Nationwide', 'text_color' => '#ffff', 'bg_color' => '#011546'],
            ['name' => 'First Direct', 'text_color' => '#ffff', 'bg_color' => '#0000',],
            ['name' => 'Monzo', 'text_color' => '#ffff', 'bg_color' => '#ff4f40',],
        ];



        foreach ($banks as $bank) {
            $bankName = $bank['name'];
            Bank::updateOrCreate(
                ['name' => $bankName],
                [
                    'logo_path' => "/$bankName.png",
                    'text_color' => $bank['text_color'],
                    'bg_color' => $bank['bg_color'],
                ]
            );
        }
    }
}
