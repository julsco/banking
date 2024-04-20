<?php

namespace Database\Seeders;

use App\Models\PaymentCategory;
use Illuminate\Database\Seeder;

class PaymentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentCategories = [
            'Salary',
            'Interest',
            'Groceries',
            'Utilities',
            'Rent/Mortgage',
            'Insurance',
            'Transportation',
            'Dining',
            'Entertainment',
            'Shopping',
            'Healthcare',
            'Education',
            'Holidays',
            'Investments',
            'Miscellaneous',
        ];

        foreach ($paymentCategories as $paymentCategory) {
            PaymentCategory::updateOrCreate(
                ['name' => $paymentCategory],
            );
        }
    }
}
