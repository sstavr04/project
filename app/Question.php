<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
		    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body','type','correct_points','wrong_points','minutes','seconds'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }


    public function type()
    {
        if ($this->isMultiple){
            return $this->hasMany(Multiple::class, 'question_id', 'id');
        }
        else{
            return $this->hasOne(Short::class, 'question_id', 'id');
        }
        
    }

    public function multiple()
    {
        return $this->hasMany(Multiple::class);
    }


    public function hint()
    {
        return $this->hasMany(Hint::class);
    }

    public function short(){
        return $this->hasOne(Short::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

    public function destroyQuestion()
    {   

        if ($this->isMultiple){//if teacher wants to delete a multiple choice question
            $multiples = Multiple::where('question_id',$this->id)->delete();
        }else{//>> >> short answered question
            $short = Short::where('question_id',$this->id)->delete();
        }
        //delete hints related to question
        $hints = Hint::where('question_id',$this->id)->delete();
        //delete question
        $this->delete();

         //return
        return;
    }
}
