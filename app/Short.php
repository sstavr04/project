<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Short extends Model
{
        		    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'correct_answer'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
