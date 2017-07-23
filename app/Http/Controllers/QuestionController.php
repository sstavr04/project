<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Quiz;
use App\Competition;
use App\Short;
use App\Multiple;
use App\Hint;

class QuestionController extends Controller
{
         /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //logged in?
        $this->middleware('auth');
        //is the user a teacher?
        $this->middleware('teacher');
        //is this teacher the creator of this competition?
        $this->middleware('teacherCreator');

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Competition $competition,Quiz $quiz,$type)
    {	
    	if ($type){//if teacher wants to create a multiple choice question type=1
        	return view('teacher.question.create_multiple')->with('competition',$competition)->with('quiz', $quiz)->with('type',$type);
    	}else{//>> >> short answered question
    		return view('teacher.question.create_short')->with('competition',$competition)->with('quiz', $quiz)->with('type',$type);
 	   	}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Competition $competition,Quiz $quiz,$type)
    {
    	$this->validate($request, [
	            'body' => 'required|string|min:1|max:2000',
	    		'correct_points' => 'required|between:0,99.99',
	    		'wrong_points' => 'required|between:0,99.99',
	    		'minutes' => 'integer|min:0|max:60',
	    		'seconds' => 'integer|min:0|max:60',
                'correct_answer' => 'required|string|min:1|max:255',  
	        ]);

    	$question=new Question;

    	$question->body = $request->input('body');
	    $question->isMultiple = $type;
		$question->correct_points = $request->input('correct_points');
	    $question->wrong_points = $request->input('wrong_points');
	    $question->minutes=$request->input('minutes');
	    $question->seconds=$request->input('seconds');
        $question->quiz_id= $quiz->id;


	    $question->save();

    	if ($type){//if teacher wants to create a multiple choice question
            

            $multiple_question = new Multiple;

            $multiple_question->answer = $request->correct_answer;
            $multiple_question->order = 1;
            $multiple_question->isCorrect=true;
            $multiple_question->question_id = $question->id;

            $multiple_question->save();
            

            //Validate and save wrong answers
            foreach ($request->options as $key => $value) {

                $multiple_question = new Multiple;

                $multiple_question->answer = $value;
                $multiple_question->order = $key+3;
                $multiple_question->isCorrect=false;
                $multiple_question->question_id = $question->id;
               
                $multiple_question->save();                
            }
	    
        }else{//question is short answered


	        //create short answer 
	        $short_question=new Short;

	    	$short_question->correct_answer = $request->input('correct_answer');
	    	$short_question->question_id = $question->id;


		    $short_question->save();
	    }

	    //Save Hints
        if ($request->hints){
            foreach ($request->hints as $key => $value) {

                $hint = new Hint;
                $hint->body = $value;
                $hint->cost = $request->hint_costs[$key];
                $hint->image = null;
                $hint->question_id=$question->id;
               
                $hint->save();                
            }
        }
        

        return redirect()->route('quiz.show',['competition'=>$competition,'quiz'=>$quiz]);
    }



    public function edit(Competition $competition,Quiz $quiz,Question $question)
    {
        return view('teacher.question.edit')->with('competition',$competition)->with('quiz', $quiz)->with('question',$question);

        /*
        if ($question->isMultiple){//if teacher wants to edit a multiple choice question
            return view('teacher.question.edit_multiple')->with('competition',$competition)->with('quiz', $quiz)->with('question',$question);
        }else{//>> >> short answered question
            return view('teacher.question.edit_short')->with('competition',$competition)->with('quiz', $quiz)->with('question',$question);
        }
        */
    }


    public function update(Request $request,Competition $competition, Quiz $quiz, Question $question)
    {
        //validate
        $this->validate($request, [
            'body' => 'required|string|min:1|max:2000',
            'correct_points' => 'required|between:0,99.99',
            'wrong_points' => 'required|between:0,99.99',
            'minutes' => 'integer|min:0|max:60',
            'seconds' => 'integer|min:0|max:60',
            'correct_answer' => 'required|string|min:1|max:255',  
        ]);

        //update question attributes
        $question->body = $request->input('body');
        $question->correct_points = $request->input('correct_points');
        $question->wrong_points = $request->input('wrong_points');
        $question->minutes=$request->input('minutes');
        $question->seconds=$request->input('seconds');

        $question->save();

        /*
        //validate and update data based on type of question
        if ($question->isMultiple){//if teacher wants to update a multiple choice question
            $this->update_multiple($request,$question);
        }else{//>> >> short answered question
            $this->update_short($request, $question);
        }
        */

         //redirect
        return redirect()->route('quiz.show',['competition'=>$competition,'quiz'=>$quiz]);

    }


    public function update_short(Request $request,Question $question)
    {
        //update short answer 
        $short = Short::where('question_id',$question->id)->get();
        $short->correct_answer = $request->input('correct_answer');

        $question->save();
         
        return;

    }

    public function update_multiple(Request $request,Question $question)
    {
        $multiples = Multiple::where('question_id',$question->id)->get();

        //correct answer first
        $correct_multiple=$multiples->where('isCorrect',true);

        $correct_multiple->answer = $request->correct_answer;
        $correct_multiple->order = 1;
        $correct_multiple->isCorrect=true;

        $correct_multiple->save();

        //Validate and save wrong answers
        foreach ($request->options as $key => $value) {
    
        }
         
        return;

    }

    
    public function destroy(Competition $competition,Quiz $quiz,Question $question)
    {   
        $question->destroyQuestion();
        
         //redirect
        return redirect()->route('quiz.show',['competition'=>$competition,'quiz'=>$quiz]);
        
    }


}
