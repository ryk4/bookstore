<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApiRequest;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function show()
    {
        return view('user.api.index');
    }

    //creates a new api for the user
    public function store(StoreApiRequest $request)
    {
        $token = Auth()->user()->createToken($request->token_name);

        return view('user.api.index',[
            'secret_api' => $token->plainTextToken
        ]);
    }
}
