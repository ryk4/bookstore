<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('user.index',[
            'user' => Auth::user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'current_password' => 'required',
        ]);

        //check if current password is correct
        if(!Hash::check($request->current_password, auth()->user()->password)){
            return back()->with('status', 'Incorrect password.');
        }

        //only validate email if it's different from what's in the DB (this is stupid ?)
        if($request->email != $user->email){
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users',
            ]);
        }

        //can this be optimized ???
        if($request->password != null){
            $request->validate([
                'password' => 'required|string|confirmed|min:8',
            ]);

            $user->password= Hash::make($request->password);
        }

        $user->name= $request->name;
        $user->email= $request->email;

        $user->save();

        return redirect()->route('book.index')
            ->with('status', 'Personal information modified!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
