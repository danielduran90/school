<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subjects;
use App\Models\User;

class SubjectController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-subject | permission:new-subject | permission:edit-subject | permission:delete-subject', ['only' => ['index']]);
        $this->middleware('permission:new-subject', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-subject', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-subject', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subjects::select('subjects.id','subjects.title','users.name')
                ->join('users', 'users.id', '=', 'subjects.exponent_id')
                ->paginate(5);

        return view('subjects.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $exponent = User::select('users.id','users.name')
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name','=','Docente')
        ->pluck('users.name', 'users.id')
        ->all();

        return view('subjects.new',compact('exponent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'exponent_id' => 'required',
        ]);
    
        Subjects::create($request->all());
    
        return redirect()->route('subject.index');
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
        $subject = Subjects::find($id);
        $subjectExponent = User::select('users.id')
        ->join('subjects', 'subjects.exponent_id', '=', 'users.id')
        ->where('subjects.id', '=', $id)
        ->pluck('users.id')
        ->all();

        $exponent = User::select('users.id','users.name')
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name','=','Docente')
        ->pluck('users.name', 'users.id')
        ->all();

        return view('subjects.edit',compact('exponent','subject', 'subjectExponent'));
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
            'title' => 'required',
            'exponent_id' => 'required',
        ]);
    
        $subject = Subjects::find($id);
        $subject->update($request->all());
    
        return redirect()->route('subject.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subjects::find($id)->delete();
        return redirect()->route('subject.index');
    }
}
