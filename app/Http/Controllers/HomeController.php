<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->isTeacher){
            return redirect()->route('home.teacher', ['id' => $user->role->id]);
        }else{
            return redirect()->route('home.student', ['id' => $user->role->id]);
        }

    }
}
