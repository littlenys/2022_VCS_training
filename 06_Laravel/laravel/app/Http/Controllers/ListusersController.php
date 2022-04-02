<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class ListusersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = User::paginate(30)->where('is_deleted', false);

        return view('listusers.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listusers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255' , 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'hoten' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phonenumber' => [ 'string', 'max:255'],
            'avatar' => ['string', 'max:512'],
            'role' => ['string', 'max:512'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hoten' => $request->hoten,
            'phonenumber' => $request->phonenumber,
            'avatar' => $request->avatar,
            'role' => $request->role,
        ]);

        event(new Registered($user));

        $tasks = User::paginate(30)->where('is_deleted', false);

        return view('listusers.index', compact('tasks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $messages = Message::where([['idsend','=',auth()->user()->id],['idrev','=',$id]])->get();

        return view('listusers.show',compact('user','messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('listusers.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->hoten = $request->hoten;
        $user->phonenumber = $request->phonenumber;
        if ($request->password != null){
            $user->password= Hash::make($request->password);
        }


        $user->save();
        return redirect()->route('listusers.index')->with('success','Cập nhật thông tin thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->is_deleted = true;
        $user->save();
        return redirect()->route('listusers.index')->with('success','Cập nhật thông tin thành công.');
    }
}
