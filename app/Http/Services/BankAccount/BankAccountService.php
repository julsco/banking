<?php

namespace App\Http\Services\BankAccount;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BankAccountService
{
    public function getBankAccountsForUser(int $userId)
    {
        $user = User::find($userId);
        return $user->bankAccounts()
            ->with([
                'currency',
                'bank',
                'cardType',
                'payments' => function ($query) {
                    $query->orderBy('date', 'DESC')
                        ->take(6);
                },
                'payments.paymentCategory',
            ])
            ->get();
    }

    public function getSpendingByCategoryForBankAccount(int $bankAccountId, string $startDate, string $endDate): Collection
    {
        return Payment::where('bank_account_id', $bankAccountId)
            ->whereBetween('date', [$startDate, $endDate])
            ->join('payment_categories', 'payments.payment_category_id', '=', 'payment_categories.id')
            ->selectRaw('payment_categories.name as category_name, SUM(payments.amount) as total_amount')
            ->groupBy('payment_categories.name')
            ->get();
    }
}
