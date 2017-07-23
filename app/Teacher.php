<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Teacher extends Model
{


    use Searchable;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'institution',
    ];


    /**
     * Get the user that is a Teacher.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function competition()
    {
        
        return $this->hasMany(Competition::class);
        
    }


}
