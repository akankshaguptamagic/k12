<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
		$this->username = 'email';
        $this->password = 'password';
		
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
            
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
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
	
	//echo "hell";
     // print_r($data);
	    User::create([
            //'firstname' => $data['firstname'],
			//'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
			//'relationship_to_child	' => $data['relationship_to_child'],
			//'phone_no_1' => $data['mobile_no']
			
        ]);
//		$sch_id=DB::table('schools')->select('id')->where('school_names',$data['school'])->first();
//		$room_id=DB::table('teachers_rooms')->select('id')->where([['school_id',$sch_id->id],['room_no',$data['classroom']]])->first();
//		$user_id=DB::table('users')->select('id')->where('email',$data['email'])->first();
//		DB::table('child_info')->insert([
//    			'school_id' => $sch_id->id,
//    			'user_id' = $user_id->id,
//				'teachers_rooms_id' => $room_id->id,
//				'childs_firstname' => $data['childs_firstname'],
//				'childs_lastname' =>$data['childs_lastname']
//										]);
    }
	public function showRegistrationForm()
	{
	   return view('auth.register');
	}
}
