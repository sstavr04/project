<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Student;
use App\Competition;
use App\Quiz;
use App\Question;
use App\Short;
use App\Multiple;
use App\Answer;

class StudentController extends Controller
{
    
	    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');

    }


    public function index(Request $request,$id)
    {
       
        $student=Student::find($id); 
        $competitions = $student->competition;
        

        $term=$request->get('search');
        if ($term){
            $searchComps=Competition::search($term)->get();
        }else{
            $searchComps=collect([]);
        }

        //dd($searchComps);
        return view('student.dashboard')->with('competitions',$competitions)->with('id',$id)->with('searchComps',$searchComps);
        
    }

    public function edit()
    {
        return view('student.edit')->with('user',Auth::user());
    }

    public function update(Request $request, $id)
    {
        //validate
        $this->validate($request, [
            'first_name' => 'nullable|string|max:25',
            'last_name' => 'nullable|string|max:25',
            'institution' => 'nullable|string',
            'nickname'=> 'nullable|string',
        ]);

        //update data
        $student=Student::find($id);

        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->institution = $request->input('institution');
        $student->nickname = $request->input('nickname');

        $student->save();


        // Need Flash message here


        //redirect
        return redirect()->route('home.student', ['id' => $id]);
    }

    public function comp($id,Competition $competition)
    {
        //Check pivot table if the student is registered
        $hasStudent = $competition->student->contains($id);
        $quizzes = Quiz::where('competition_id',$competition->id)->get();
        

        if($hasStudent){
            $registered=true;
        }else{
            $registered=false;
        }

        return view('student.competition.show')->with('competition',$competition)->with('registered',$registered)->with('id',$id)->with('quizzes',$quizzes);

    }

    public function compRegister(Request $request,$id,Competition $competition)
    {
        //Attach student to competition
        $competition->student()->attach($id);
        
        //redirect
        return redirect()->route('student.comp.show', ['id' => $id,'competition'=>$competition]);

    }


    public function liveQuiz(Competition $competition, Quiz $quiz)
    {
           
        $questions=Question::where('quiz_id',$quiz->id)->with(['multiple','short'])->get();   
        
        return view('student.quiz.live')->with('competition',$competition)->with('quiz',$quiz)->with('questions',$questions);

    }

    public function response()
    {
        
        $user = Auth::user();
        $student = Student::where('user_id',$user->id)->first();
       

        $answer= Answer::forceCreate([
            'answer' => request('answer'),
            'student_id' => $student->id,
            'question_id' => request('question_id'),

        ]);

        return;
        
    }



}
