<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('user.settings.index', compact('user'));
    }

    public function update(UpdateUserRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password !== null ? Hash::make($request->password) : $user->getAuthPassword()
        ]);

        return redirect()->route('books.index')
            ->with('status', 'Personal information modified!');
    }
}
