<?php

namespace Database\Seeders\Dummy;

use App\Models\BankAccount;
use App\Models\Payment;
use App\Models\PaymentCategory;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DummyPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $bankAccounts = BankAccount::all();
        $salaryCategory = PaymentCategory::where('name', 'Salary')->first();

        foreach ($bankAccounts as $bankAccount) {
            for ($month = 1; $month <= 12; $month++) {
                // Create one salary payment on the first day of each month
                Payment::create([
                    'amount' => $faker->numberBetween(2000, 3000), // positive amount for salary
                    'date' => now()->startOfYear()->addMonths($month - 1)->startOfMonth()->format('Y-m-d'),
                    'description' => $faker->word,
                    'payment_category_id' => $salaryCategory->id,
                    'bank_account_id' => $bankAccount->id,
                ]);

                // Create exactly 5 additional random payments (expenses) per month
                for ($i = 0; $i < 40; $i++) {
                    $randomCategory = PaymentCategory::where('name', '!=', 'Salary')->inRandomOrder()->first();

                    Payment::create([
                        'amount' => -$faker->numberBetween(3, 60), // negative amount for expenses
                        'date' => $faker->dateTimeBetween(
                            now()->startOfYear()->addMonths($month - 1)->startOfMonth()->format('Y-m-d'),
                            now()->startOfYear()->addMonths($month - 1)->endOfMonth()->format('Y-m-d')
                        )->format('Y-m-d'),
                        'description' => $faker->word,
                        'payment_category_id' => $randomCategory->id,
                        'bank_account_id' => $bankAccount->id,
                    ]);
                }
            }
        }
    }
}
