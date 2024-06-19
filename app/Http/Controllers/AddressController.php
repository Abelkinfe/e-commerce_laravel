<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function address(Request $request)
    {
        
        $validatedData = $request->validate([
            'city' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'country_name' => 'required|string|max:255',
        ]);

       
        $country = Country::firstOrCreate(['country_name' => $validatedData['country_name']]);

       
        $address = Address::create([
            'city' => $validatedData['city'],
            'region' => $validatedData['region'],
            'country_id' => $country->id,
        ]);

        return response()->json(['message' => 'Location created successfully', 'data' => $address], 201);
    }
}
