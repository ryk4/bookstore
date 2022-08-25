<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApiTokenRequest;

class ApiTokenController extends Controller
{
    public function index()
    {
        return view('user.api-settings.index');
    }

    public function store(StoreApiTokenRequest $request)
    {
        $token = Auth()->user()->createToken($request->token_name);

        return view('user.api.index', [
            'secret_api' => $token->plainTextToken
        ]);
    }
}
