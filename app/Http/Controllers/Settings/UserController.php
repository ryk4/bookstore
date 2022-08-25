<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('user.settings.index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'current_password' => 'required',
        ]);

        //check if current password is correct
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->with('status', 'Incorrect password.');
        }

        //only validate email if it's different from what's in the DB (this is stupid ?)
        if ($request->email != auth()->user()->email) {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users',
            ]);
        }

        //can this be optimized ???
        if ($request->password != null) {
            $request->validate([
                'password' => 'required|string|confirmed|min:8',
            ]);

            auth()->user()->password = Hash::make($request->password);
        }

        auth()->user()->name = $request->name;
        auth()->user()->email = $request->email;

        auth()->user()->save();

        return redirect()->route('books.index')
            ->with('status', 'Personal information modified!');
    }
}
