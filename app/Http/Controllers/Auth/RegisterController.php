<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Teacher;
use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'isTeacher' => 'required|boolean',
            'first_name' => 'nullable|string|max:25',
            'last_name' => 'nullable|string|max:25',
            'institution' => 'nullable|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        /* CREATE USER*/
        $user= new User;
        $user->isTeacher=$data['isTeacher'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);

        $user->save();

        /* CREATE ROLE*/
        if ($data['isTeacher']==1){
            
            $teacher = new Teacher;
            $teacher->user_id=$user->id;
            $teacher->first_name = $data['first_name'];
            $teacher->last_name = $data['last_name'];
            $teacher->institution = $data['institution'];

            $teacher->save();
        }else{
            $student = new Student;
            $student->user_id=$user->id;
            $student->first_name = $data['first_name'];
            $student->last_name = $data['last_name'];
            $student->institution = $data['institution'];

            $student->save();
        }



        return $user;

    }

    
}
