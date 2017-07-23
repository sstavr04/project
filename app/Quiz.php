<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

		    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','isLive'
    ];

         /**
     * Get the user that is a Teacher.
     */
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function question()
    {
        
        return $this->hasMany(Question::class);
        
    }

    public function destroyQuiz()
    {   
        //get the questions of this quiz
        $questions= Question::where('quiz_id',$this->id)->get();
        foreach ($questions as $question) {
            //destroy each question
            $question->destroyQuestion();
        }

        //delete quiz
        $this->delete();

         //return
        return;
    }
}
