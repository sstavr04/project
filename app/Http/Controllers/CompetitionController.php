<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Quiz;
use Illuminate\Http\Request;
use Auth;


class CompetitionController extends Controller
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
        $this->middleware('teacherCreator', ['except' => ['index','create','store']]);
        
        

    }

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
        return view('teacher.competition.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'name' => 'required|string|min:1|max:255',
            'code' => 'required|string|min:1|max:25',
            
        ]);

        //update data
        $comp=new Competition;

        $comp->name = $request->input('name');
        $comp->code = $request->input('code');
        $comp->teacher_id = Auth::user()->role->id;

        $comp->save();

         //redirect
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {
        $quizzes = Quiz::where('competition_id',$competition->id)->get();
        return view('teacher.competition.show')->with('competition',$competition)->with('quizzes',$quizzes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition)
    {
        return view('teacher.competition.edit')->with('competition',$competition);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {
         //validate
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:25',
            
        ]);

        //update data
        $competition->name = $request->input('name');
        $competition->code = $request->input('code');

        $competition->save();

         //redirect
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        $competition->destroyComp();
        
       
         //redirect
        return redirect()->route('home');
        
    }
}
