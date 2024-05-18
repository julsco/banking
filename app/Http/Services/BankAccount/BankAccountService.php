<?php

namespace App\Http\Services\BankAccount;

use App\Models\User;

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
}
