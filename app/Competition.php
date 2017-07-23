<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Competition extends Model
{

    use Searchable;

    public function toSearchableArray()
    {
                // Customize array...
        $array=$this->toArray();
        $array['teacher']=$this->teacher['first_name'];
        //dd($array);
        return $array;
        //return $this->toArray();
    }
    


	    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','code'
    ];

     /**
     * Get the user that is a Teacher.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }


    /**
     * Many to many students register to competitions.
     */
    public function student()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    public function quiz()
    {
        
        return $this->hasMany(Quiz::class);
        
    }

    public function destroyComp()
    {   
        //get the quizzes of this comp
        $quizzes= Quiz::where('competition_id',$this->id)->get();
        foreach ($quizzes as $quiz) {
            //destroy each quiz
            $quiz->destroyQuiz();
        }

        //delete quiz
        $this->delete();

         //return
        return;
    }
}
