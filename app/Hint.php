<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hint extends Model
{
        		    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body','image','cost'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
