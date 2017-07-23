<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Competition;
use App\Question;

class QuizController extends Controller
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
        $this->middleware('teacherCreator');

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
    public function create(Competition $competition)
    {
        return view('teacher.quiz.create')->with('competition', $competition);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Competition $competition)
    {
        //validate
        $this->validate($request, [
            'name' => 'required|string|min:1|max:255',
    		'isLive' => 'boolean'
            
        ]);

        //update data
        $quiz=new Quiz;

        $quiz->name = $request->input('name');
        $quiz->competition_id = $competition->id;

        $quiz->save();

         //redirect
        return redirect()->route('quiz.show',['competition'=>$competition,'quiz'=>$quiz]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition, Quiz $quiz)
    {
        $questions= Question::where('quiz_id',$quiz->id)->get();
        return view('teacher.quiz.show')->with('competition',$competition)->with('quiz',$quiz)->with('questions',$questions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition,Quiz $quiz)
    {
        return view('teacher.quiz.edit')->with('competition',$competition)->with('quiz',$quiz);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Competition $competition, Quiz $quiz)
    {
    	//validate
        $this->validate($request, [
            'name' => 'required|string|min:1|max:255',
        
            
        ]);

        //update data
        $quiz->name = $request->input('name');

        $quiz->save();

         //redirect
        return redirect()->route('competition.show',$competition->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition, Quiz $quiz)
    {

        $quiz->destroyQuiz();
        
         //redirect
        return redirect()->route('competition.show',$competition->id);
        

    }




}
