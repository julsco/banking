<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankAccountRequest;
use App\Http\Services\BankAccount\BankAccountService;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class BankAccountController extends Controller
{
    private BankAccountService $bankAccountService;

    public function __construct(BankAccountService $bankAccountService)
    {
        $this->bankAccountService = $bankAccountService;
    }

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
            $bankAccounts = $this->bankAccountService->getBankAccountsForUser($userId);

            return response()->json($bankAccounts);
        } catch (Throwable $e) {
            $errorMessage = "Error retrieving Bank accounts for user_id: $userId";
            Log::error($errorMessage);

            return response()->json($e, 500);
        }
    }

    public function setMainBankAccount(int $bankAccountId): JsonResponse
    {
        try {
            $user = auth()->user();
            if ($user->mainBankAccount()->exists()) {
                $user->mainBankAccount()->updateExistingPivot(null, ['is_main' => false]);
            }
            $mainBankAccount = BankAccount::find($bankAccountId);
            $user->setMainBankAccount($mainBankAccount);

            return response()->json('Successfully set main bank account');
        } catch (Throwable $e) {
            $errorMessage = "Error setting main bank account for user_id $user->id";
            Log::error($errorMessage);

            return response()->json($e, 500);
        }
    }

    public function getSpendingByCategoryForBankAccount($bankAccountId, $startDate, $endDate): JsonResponse
    {
        try {
            $totalSpendingByCategory = $this->bankAccountService
                ->getSpendingByCategoryForBankAccount($bankAccountId, $startDate, $endDate);

            return response()->json($totalSpendingByCategory);
        } catch (Throwable $e) {
            $errorMessage = "Error retrieving total spending by category for bank_account_id $bankAccountId";
            Log::error($errorMessage);

            return response()->json($e, 500);
        }
    }
}
