<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show($user_id){
        if(Auth::user()->id == $user_id){
            $user = User::findOrFail($user_id);
        }
        else {
            abort(404);
        }

        return view('users.show', compact('user'));
    }

    public function edit($user_id){
        if(Auth::user()->id == $user_id){
            $user = User::findOrFail($user_id);
        }
        else {
            abort(404);
        }

        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user){
        $path_image=Auth::user()->img;
        if($request->hasFile('img') && $request->file('img')->isValid()){
            $path_name=$request->file('img')->getClientOriginalName();
            $path_image=$request->file('img')->storeAs('public/images/profile',$path_name);
        };

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'img' => $path_image,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
        ]);

        return redirect()->route('users.show', ['user' => Auth::user()->id]);
    }
}
