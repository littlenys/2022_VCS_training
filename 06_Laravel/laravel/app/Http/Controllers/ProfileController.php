<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        auth()->user()->update($request->only('email','phonenumber'));

        if($request->input('password')){
            auth()->user()->update(['password'=>bcrypt($request->input('password'))
        ]);
        }

        return redirect()->route(route:'profile')->with('message','Profile saved successfully');

    }
}
