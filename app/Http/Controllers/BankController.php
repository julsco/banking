<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class BankController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $banks = Bank::all();
            return response()->json($banks);
        } catch (Throwable $e) {
            $errorMessage = 'Error retrieving all Banks';
            Log::error($errorMessage);

            return response()->json($e, 500);
        }
    }
}
