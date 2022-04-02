<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileAttach;
use App\Models\Submission;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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

        $path = $request->file('file')->store('public/files');
        $savepath = Storage::path($path);

        $partid = Submission::create([
            'authorid' =>  auth()->user()->id,
            'assignmentid' => $request->assignmentid,
        ])->id;

        $attach = FileAttach::create([
            'part' =>  "submission",
            'partid' => $partid,
            'tenfile' =>  $name,
            'url' => $savepath
        ]);

        return redirect(route('assignment.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        //
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
