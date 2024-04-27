<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankAccountRequest;
use App\Models\BankAccount;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class BankAccountController extends Controller
{
    public function create(BankAccountRequest $request): JsonResponse
    {
        $validatedRequest = $request->validated();
        try {
            $bank_account = BankAccount::create([
                'bank_id' => $validatedRequest['bank_id'],
                'card_type_id' => $validatedRequest['card_type_id'],
                'currency_id' => $validatedRequest['currency_id'],
                'account_number' => $validatedRequest['account_number'],
                'sort_code' => $validatedRequest['sort_code'],
            ]);

            $bank_account->users()->sync($validatedRequest['user_ids']);

            return response()->json($bank_account);
        } catch (Throwable $e) {
            $errorMessage = 'Error creating a Bank Account';
            Log::error($errorMessage);

            return response()->json($e, 500);
        }
    }

    public function getBankAccountsForUser(int $userId): JsonResponse
    {
        try {
            $user = User::find($userId);
            $bankAccounts = $user->bankAccounts()->with('payments')->get();

            return response()->json($bankAccounts);
        } catch (Throwable $e) {
            $errorMessage = "Error retrieving Bank accounts for user_id: $userId";
            Log::error($errorMessage);

            return response()->json($e, 500);
        }
    }
}
