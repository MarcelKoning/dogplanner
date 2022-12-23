<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Dog;


class ProfileController extends Controller
{
    public function index() {

        $userId = Auth::id();
        $dogs = Dog::all()->where('id_user', $userId);


        return view('layout/profile', compact('dogs'));
    }

    public function update(Request $request, User $profile)
    {
        //$profile->update($request->all());
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->telephone = $request->telephone;
        $profile->house_number = $request->house_number;
        $profile->postal_code = $request->postal_code;

        if($request->password)
        {
            $profile->password = Hash::make($request->password);
        }
        $profile->save();


        return redirect()->route('profile.index');
    }

    public function show(User $user) {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = "edit";
        return view('layout/profile')->with(compact("user"))->with(compact("form"));
    }


}
