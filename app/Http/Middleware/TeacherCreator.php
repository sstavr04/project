<?php

namespace App\Http\Middleware;

use Closure;
use App\Competition;
use App\Quiz;
use App\Teacher;
use Auth;

class teacherCreator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   

        //dd($request->quiz);
        
        if ($request->competition!=null){
            if($request->competition->teacher->id == Auth::user()->role->id){
                return $next($request);
            }
        }elseif($request->quiz!=null){
            $competition=Competition::where('id',$request->quiz->competition_id)->first();
            if($competition->teacher->id == Auth::user()->role->id){
                return $next($request);
            }
        }
        return redirect('/');
        
    }
}
