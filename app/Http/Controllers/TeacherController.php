<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Teacher;
use App\Competition;



class TeacherController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');

    }
    
    public function index($id)
    {
        $competitions = Competition::where('teacher_id', $id)->orderBy('created_at', 'desc')->get();
        return view('teacher.dashboard')->with('competitions',$competitions);
    }

    public function edit()
    {
        return view('teacher.edit')->with('user',Auth::user());
    }

    public function update(Request $request, $id)
    {
        //validate
        $this->validate($request, [
            'first_name' => 'nullable|string|max:25',
            'last_name' => 'nullable|string|max:25',
            'institution' => 'nullable|string',
            
        ]);

        //update data
        $teacher=Teacher::find($id);

        $teacher->first_name = $request->input('first_name');
        $teacher->last_name = $request->input('last_name');
        $teacher->institution = $request->input('institution');

        $teacher->save();


        // Need Flash message here


        //redirect
        return redirect()->route('home.teacher', ['id' => $id]);
    }
}

