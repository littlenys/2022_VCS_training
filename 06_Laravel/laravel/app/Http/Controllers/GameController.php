<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileAttach;
use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use File;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $game = Game::paginate(30);
        $author = User::paginate();
        $iscorrect = null;
        $fileattach = FileAttach::paginate();
        return view("game.index", compact('game', 'author', 'fileattach', 'iscorrect'));
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
        $validatedData = $request->validate([
            'file' => 'required',

        ]);

        $name = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($name, PATHINFO_FILENAME);

        $path = $request->file('file')->store('public/files');
        $savepath = Storage::path($path);

        $partid = Game::create([
            'authorid' =>  auth()->user()->id,
            'goiy' => $request->goiy
        ])->id;

        $attach = FileAttach::create([
            'part' =>  "game",
            'partid' => $partid,
            'tenfile' =>  md5($filename),
            'url' => $savepath
        ]);

        return redirect(route('game.index'));
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
    public function update(Request $request, $id)
    {
        $iscorrect = null;
        $fileattach = FileAttach::paginate();
        $game = Game::find($id);
        $correct = FileAttach::where([['part', '=', 'game'], ['partid', '=', $game->id]])->first();
        if ($correct->tenfile == md5($request->result)) {
            $iscorrect = true;
            $content = File::get($correct->url);
            return view("game.show", compact('iscorrect','content'));
        } else {
            $iscorrect = false;
            return view("game.show", compact('iscorrect'));
        }


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
