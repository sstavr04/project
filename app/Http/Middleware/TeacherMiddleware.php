<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class TeacherMiddleware
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
        $id= $request->id;        
        if ($id!=null){
            if((Auth::user()->isTeacher) &&  (Auth::user()->role->id== $id)) {
                return $next($request);
            }
        }elseif(Auth::user()->isTeacher){
            return $next($request);
        }

        return redirect('/');
        
    }
}
