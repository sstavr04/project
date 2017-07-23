<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
         /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer'
    ];

 
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
