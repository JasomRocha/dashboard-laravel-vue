<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $clients = Client::all();

        $products =[
            [
                'id' => 1,
                'name' => 'video game',
                'value' => '10.50',
                'qtd' => '10'    
            ]
        ];

        return response()
        ->json([
            'clients' => $clients,
            'products' => $products   
        ]);
    }


    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $token = Auth::user()->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
}
}
