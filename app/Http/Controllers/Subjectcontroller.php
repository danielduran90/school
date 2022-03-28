<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subjects;
use App\Models\Assigned_subjects;
use App\Models\User;

class SubjectController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-subject', ['only' => ['index']]);
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
        $user = User::find(auth()->id());
        if ($user->hasPermissionTo("edit-subject")) {
            $subjects = Subjects::select('subjects.id','subjects.title','users.name')
                ->join('users', 'users.id', '=', 'subjects.exponent_id')
                ->paginate(5);
        }else{
            $subjects = Subjects::select('subjects.id','subjects.title','users.name')
                ->join('users', 'users.id', '=', 'subjects.exponent_id')
                ->where('users.id', auth()->id())
                ->paginate(5);
        }

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

        $students = User::select('users.id','users.name')
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name','=','estudiante')
        ->get();

        return view('subjects.new',compact('exponent', 'students'));
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
    
        $subjects =Subjects::create([
            'title' => $request['title'],
            'exponent_id' => $request['exponent_id'],
        ]);

        foreach ($request['students'] as $key => $val) {
            Assigned_subjects::create([
                'user_id' => $val,
                'subject_id' => $subjects->id
            ]);
        }
        
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
        $subjectExponent = $this->GetIdSubjectExponent($id);
        $exponents = $this->GetExponents();
        $students =  $this->GetStudents();
        $assignedStudents = $this->GetAssignedStudents($id);

        return view('subjects.edit', compact('exponents', 'subject', 'students', 'assignedStudents', 'subjectExponent'));
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
        $subject->update([
            'title' => $request['title'],
            'exponent_id' => $request['exponent_id']
        ]);
        
        foreach ($request['students'] as $key => $val) {
            $isaAsigned =  $this->GetUserAssignedToTheSubject($id, $val);
            if (!count($isaAsigned)) {
                Assigned_subjects::create([
                    'user_id' => $val,
                    'subject_id' => $id
                ]);
            }
        }

        Assigned_subjects::where('subject_id', $id)
        ->whereNotIn('user_id', $request['students'])
        ->delete();
    
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
        Assigned_subjects::where('subject_id', $id)->delete();
        return redirect()->route('subject.index');
    }

    public function GetIdSubjectExponent($id)
    {
        $userExponent = User::select('users.id')
        ->join('subjects', 'subjects.exponent_id', '=', 'users.id')
        ->where('subjects.id', '=', $id)
        ->pluck('users.id')
        ->all();

        return $userExponent;
    }

    public function GetExponents()
    {
        $exponents = User::select('users.id','users.name')
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name','=','Docente')
        ->pluck('users.name', 'users.id')
        ->all();

        return $exponents;
    }

    public function GetStudents()
    {
        $students = User::select('users.id','users.name')
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name','=','estudiante')
        ->get();

        return $students;
    }

    public function GetAssignedStudents($id)
    {
        $students = User::select('users.id')
        ->join('assigned_subjects', 'assigned_subjects.user_id', '=', 'users.id')
        ->where('assigned_subjects.subject_id','=', $id)
        ->pluck('users.id')
        ->all();

        return $students;
    }

    public function GetUserAssignedToTheSubject($id, $user)
    {
        $students = Assigned_subjects::select('user_id')
        ->where('assigned_subjects.user_id','=', $user)
        ->where('assigned_subjects.subject_id','=', $id)
        ->get();

        return $students;
    }
}
