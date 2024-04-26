<?php

namespace App\Http\Controllers;

use App\Models\PaymentCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class PaymentCategoryController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $cardTypes = PaymentCategory::all();
            return response()->json($cardTypes);
        } catch (Throwable $e) {
            $errorMessage = 'Error retrieving all Payment Categories';
            Log::error($errorMessage);

            return response()->json($e, 500);
        }
    }
}
