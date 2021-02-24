<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function show()
    {
        return view('user.api.index');
    }

    //creates a new api for the user
    public function store(Request $request)
    {

        $token = Auth()->user()->createToken($request->token_name);


        dd($token->plainTextToken);//need to display this once for the user in some pop up box

        return view('user.api.index');

    }
}
