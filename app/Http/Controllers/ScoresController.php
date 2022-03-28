<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assigned_subjects;
use App\Models\User;

class ScoresController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:view-scores', ['only' => ['index']]);
        $this->middleware('permission:edit-scores', ['only' => ['edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->id());
        if ($user->hasPermissionTo("edit-scores")) {
            $scores = Assigned_subjects::select('users.name','assigned_subjects.id','subjects.title','assigned_subjects.score', 'subjects.exponent_id')
                ->join('users', 'users.id', '=', 'assigned_subjects.user_id')
                ->join('subjects', 'subjects.id', '=', 'assigned_subjects.subject_id')
                ->paginate(5);
        }else{
            $scores = Assigned_subjects::select('users.name','assigned_subjects.id','subjects.title','assigned_subjects.score')
                ->join('users', 'users.id', '=', 'assigned_subjects.user_id')
                ->join('subjects', 'subjects.id', '=', 'assigned_subjects.subject_id')
                ->where('users.id', auth()->id())
                ->paginate(5);
        }

        return view('scores.index',compact('scores'));
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
        $assignedsSubjects = Assigned_subjects::select('users.name','assigned_subjects.id','subjects.title','assigned_subjects.score')
        ->join('users', 'users.id', '=', 'assigned_subjects.user_id')
        ->join('subjects', 'subjects.id', '=', 'assigned_subjects.subject_id')
        ->where('assigned_subjects.id', $id)
        ->get();
        $assignedsSubjects = $assignedsSubjects[0];
        return view('scores.edit',compact('assignedsSubjects'));
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
        request()->validate([
            'score' => 'numeric|required',
        ]);

        $assignedsSubjects = Assigned_subjects::find($id);
        $assignedsSubjects->score = $request->input('score');
        $assignedsSubjects->save();
        return redirect()->route('scores.index');
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
