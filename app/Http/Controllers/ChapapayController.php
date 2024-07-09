<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller; // Ensure this import is present

class ChapapayController extends Controller
{
    public function initializeTransaction(Request $request)
    {
        $chapaToken = "CHASECK_TEST-FBcYDRuNHfLgu8qD7rQedPxDieEyXlyH";
        $url = 'https://api.chapa.co/v1/transaction/initialize';

        try {
            // $response = Http::withHeaders([
            //     'Authorization' => 'Bearer ' . $chapaToken,
            //     'Content-Type' => 'application/json'
            // ])->post($url, $request->all());
            $response = Http::withToken($chapaToken)
            ->post($url, $request->all());
                
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
