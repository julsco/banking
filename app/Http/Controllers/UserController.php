<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $cardTypes = User::all();
            return response()->json($cardTypes);
        } catch (Throwable $e) {
            $errorMessage = 'Error retrieving all Users';
            Log::error($errorMessage);

            return response()->json($e, 500);
        }
    }
}
