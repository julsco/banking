<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class PaymentController extends Controller
{
    public function create(PaymentRequest $request): JsonResponse
    {
        $validatedRequest = $request->validated();
        try {
            $payment = Payment::create([
                'payment_category_id' => $validatedRequest['payment_category_id'],
                'bank_account_id' => $validatedRequest['bank_account_id'],
                'description' => $validatedRequest['description'],
                'amount' => $validatedRequest['amount'],
                'date' => $validatedRequest['date'],
            ]);

            return response()->json($payment);

        } catch (Throwable $e) {
            $errorMessage = 'Error creating Payment';
            Log::error($errorMessage);

            return response()->json($e, 500);
        }
    }

    public function getAllPaymentsForBankAccount(int $bankAccountId): JsonResponse
    {
        try {
            $payments = Payment::where('bank_account_id', $bankAccountId)
                ->with('paymentCategory')
                ->orderBy('date', 'desc')
                ->get()
                ->groupBy('date');

            return response()->json($payments);

        } catch (Throwable $e) {
            $errorMessage = 'Error retrieving payments for bank account';
            Log::error($errorMessage);

            return response()->json($e, 500);
        }
    }
}
