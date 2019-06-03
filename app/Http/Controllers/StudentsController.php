<?php

namespace App\Http\Controllers;

use App\Student;
use App\GradeLevel;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Student $student, GradeLevel $grade_level)
    {
        return view('students/index', [
            'students' => Auth::user()->students->all(),
            'grade_levels' => $grade_level->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GradeLevel $grade_level)
    {
        return view('students/create', [
            'grade_levels' => $grade_level->all()
        ]);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'required',
            'grade_level' => 'required'
        ]);

        Auth::user()->addStudent($request);

        flash("Student saved successfully");

        return redirect('/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student, GradeLevel $grade_level)
    {
        return view('students/show', [
            'student' => $student,
            'grade_level' => $grade_level->find($student->grade_level_id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student, GradeLevel $grade_level)
    {
        return view('students/edit', [
            'student' => $student,
            'grade_levels' => $grade_level->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Student  $student
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        // dd($request->all());

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'required',
            'grade_level' => 'required'
        ]);

        $student->find($student->id)->updateStudent($request);

        flash("Student successfully updated");

        return redirect('/students/'. $student->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        flash('Student successfully deleted');
        return redirect('/students');
    }
}
