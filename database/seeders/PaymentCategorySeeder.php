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
            ['name' => 'Salary', 'icon' => 'fa-hand-holding-dollar'],
            ['name' => 'Interest', 'icon' => 'fa-percent'],
            ['name' => 'Groceries', 'icon' => 'fa-cart-shopping'],
            ['name' => 'Utilities', 'icon' => 'fa-bolt'],
            ['name' => 'Rent/Mortgage', 'icon' => 'fa-house-user'],
            ['name' => 'Insurance', 'icon' => 'fa-shield'],
            ['name' => 'Transportation', 'icon' => 'fa-car'],
            ['name' => 'Cafe & Restaurant', 'icon' => 'fa-mug-hot'],
            ['name' => 'Entertainment', 'icon' => 'fa-icons'],
            ['name' => 'Shopping', 'icon' => 'fa-bag-shopping'],
            ['name' => 'Healthcare', 'icon' => 'fa-briefcase-medical'],
            ['name' => 'Education', 'icon' => 'fa-user-graduate'],
            ['name' => 'Child Activity', 'icon' => 'fa-baseball-bat-ball'],
            ['name' => 'Holidays', 'icon' => 'fa-umbrella-beach'],
            ['name' => 'Investments', 'icon' => 'fa-sack-dollar'],
            ['name' => 'Miscellaneous', 'icon' => 'fa-circle-question'],
        ];

        foreach ($paymentCategories as $category) {
            PaymentCategory::updateOrCreate(
                ['name' => $category['name']],
                ['icon' => $category['icon']],
            );
        }
    }
}
