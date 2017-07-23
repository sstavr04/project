<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multiple extends Model
{
    		    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer','order','isCorrect'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class,'question_id');
    }
}
