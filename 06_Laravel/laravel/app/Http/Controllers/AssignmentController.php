<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileAttach;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $assignments = Assignment::paginate(30);
        $author = User::paginate();
        $fileattach = FileAttach::paginate();
        return view("fileattach.index", compact('assignments','author','fileattach'));
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

        $path = $request->file('file')->store('public/files');
        $savepath = Storage::path($path);

        $partid = Assignment::create([
            'authorid' =>  auth()->user()->id,
            'name' => $request->name,
            'due' => $request->due
        ])->id;

        $attach = FileAttach::create([
            'part' =>  "assignment",
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
        $assignmentid = $id;
        $assignment= Assignment::find($id);
        $author = User::paginate();
        $submission = Submission::where([['assignmentid','=',$assignmentid]])->get();
        $fileattach = FileAttach::paginate();

        return view("fileattach.submit", compact('assignmentid','assignment','submission','author','fileattach'));
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
