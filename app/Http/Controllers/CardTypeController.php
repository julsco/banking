<?php

namespace App\Http\Controllers;

use App\Models\CardType;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class CardTypeController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $cardTypes = CardType::all();
            return response()->json($cardTypes);
        } catch (Throwable $e) {
            $errorMessage = 'Error retrieving all Card Types';
            Log::error($errorMessage);

            return response()->json($e, 500);
        }
    }
}
