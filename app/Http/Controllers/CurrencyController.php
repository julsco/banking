<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class CurrencyController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $currencies = Currency::all();
            return response()->json($currencies);
        } catch (Throwable $e) {
            $errorMessage = 'Error retrieving all Currencies';
            Log::error($errorMessage);

            return response()->json($e, 500);
        }
    }
}
