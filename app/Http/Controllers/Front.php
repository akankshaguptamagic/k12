<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\JoinRequest;
use App\User;
use App\Schools;
use App\TeachersRoom;

use DB;
use Mail;
use Flash;
use Session;
use App\SchoolPhotos;
use Services_Twilio_Twiml;
use Services_Twilio;
use Services_Twilio_TinyHttp;

use Auth;

class Front extends Controller
{



 public function schoolphotos(){

      return view('adminphotos');

    }

    public function showphotos(){

       $data = SchoolPhotos::all();
       $data = $data->toArray();
		
        return view('showphotos', ['data' => $data]);
    }

    public function uploadphotos(){
    
    $images_name = array();
      // getting all of the post data
    $files = Input::file('photos');
    // Making counting of uploaded images
    $file_count = count($files);
    // start count how many uploaded
    $uploadcount = 0;
    foreach($files as $file) {
      $rules = array('file' => 'required|mimes:png,gif,jpeg'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
      $validator = Validator::make(array('file'=> $file), $rules);
      if($validator->passes()){
        $destinationPath = public_path() . '/school_photos';
        //$filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension(); // getting image extension
        $filename = rand(11111,99999).'.'.$extension;
        $upload_success = $file->move($destinationPath, $filename);
        $uploadcount ++;
        array_push($images_name, $filename);
      }
    }
    if($uploadcount == $file_count){

      $images_implode = implode("~", array_filter($images_name));
      $data = new SchoolPhotos;
      $data->school_id = Input::get('school');
      $data->album_name = Input::get('album_name');
      $data->photos = $images_implode;
      $data->save();
      Session::flash('message', 'Photo Uploaded Successfully!');
      return Redirect::to('schoolphotos');
    } 
    else {
      return Redirect::to('schoolphotos')->withInput()->withErrors($validator);
    }
      
    }

    
    public function joinrequest()
    {
		$schools = Schools::orderBy('school_names', 'asc')->get();
        return view('joinrequest', compact('schools'));
    }
	
	public function categoryDropDownData()
		{

 		  $cat_id = Input::get('cat_id');
		  $subcategories = TeachersRoom::where('school_id', '=', $cat_id)
                  ->orderBy('room_no', 'asc')
                  ->get();
        
		 return \Response::json($subcategories);


	}
	
	public function profile()
    {
        return view('account_settings');
    }
	public function calender()
    {
        return view('calender');
    }
	
	
	public function home()
	{
        if(Auth::check())
            return Redirect::to('/home')->with('flash_notice', 'You are already logged in!');

        return view('welcome');
    }

	
    public function saverequest()
    {
	
		$validator = Validator::make(Input::all(), JoinRequest::$rules);

		if ($validator->fails()) 
		{
			
			// get the error messages from the validator
			$messages = $validator->messages();
			
			// redirect our user back to the form with the errors from the validator
			return Redirect::back()->withErrors($validator);
			
		}
    	///////////////Here is the code to match request record to actual school database record and check condition to verify user...If user request record is completely match to school record then user receive email//////
		$is_sch = DB::table('parent_details')->where('sch_id',Input::get('school'))->get();
		$flag=0;
		foreach($is_sch as $p_info)
		{
			$is_info = DB::table('parent_details')->where([['email',Input::get('email')],['name',Input::get('firstname').Input::get('lastname')],['child_name',Input::get('childs_firstname').Input::get('childs_lastname')],['classroom',Input::get('classroom')],['mobile_no',Input::get('mobile_no')],['sch_id',$p_info->sch_id]])->get();
			if($is_info)
			{
				$flag=1;
				break;
			}
		}
		
		if($flag)
		{
		  $data = new JoinRequest;
		  $qry=DB::table('schools')->select('school_names')->where('id',Input::get('school'))->first();
		  $data->email = Input::get('email');
		  $data->firstname = Input::get('firstname');
		  $data->lastname = Input::get('lastname');
		  
		  $data->school = $qry->school_names;
	      $data->childs_firstname = Input::get('childs_firstname');
		  $data->childs_lastname = Input::get('childs_lastname');
		  $data->relationship_to_child = Input::get('relationship_to_child');
		  $data->classroom = Input::get('classroom');
		  $data->mobile_no = Input::get('mobile_no');
		  $data->note = Input::get('note');
		  $confirmation_code = str_random(30);
		  $data->email_confirmation_code=$confirmation_code;
		  $data->save();
		
		  Mail::send('emails.verify', compact('confirmation_code'), function($message) {
	 	   $message->to(Input::get('email'), Input::get('firstname'))->subject('Verify your email address');
		  });
		}
		else
		{
			Session::flash('message', 'Sorry Your details are not matched with school!!!');
			return Redirect::back();
		}
		
		
////////////////////////////////
			

//include('twilio-php\Services\Twilio.php');

/////here is the code to generate OTP token for mobile verifying
//$sid = "ACda610e6c5b6d4fa88b72e2bf7fcd6281"; // Your Account SID from www.twilio.com/user/account
//$token = "a30ab003f2fefff9cb100971595bdb99"; // Your Auth Token from www.twilio.com/user/account
//
//$http = new Services_Twilio_TinyHttp(
//    'https://api.twilio.com',
//    array('curlopts' => array(
//        CURLOPT_SSL_VERIFYPEER => false,
//        CURLOPT_SSL_VERIFYHOST => 2,
//    ))
//);
//
//$client = new Services_Twilio($sid, $token, "2010-04-01", $http);
// $otp = rand(100000, 999999);
// $sms_content = "Thanks for registration: Your verification code is $otp";
//  
//$client->account->messages->create(array(
//  'To' => "+919015757091",
//  'From' => "+17206082809",
//  'Body' => $sms_content
// // 'MediaUrl' => "https://climacons.herokuapp.com/clear.png", 
//));





			///////////////
			
			
			Session::flash('message', 'Request Sent Successfully..Please Check Email To Process Further!!!!');
			 return Redirect::back();
    
			}
			
		 public function confirm($confirmation_code)
    	 {
			if( ! $confirmation_code)
			{
				return view('auth.login');
			}
	
			
			$user = JoinRequest::where('email_confirmation_code', $confirmation_code)->first();
			
			if ( ! $user)
			{
				return view('auth.login');
			}
			
			$user->email_confirmed = 1;
			$user->email_confirmation_code = null;
			$user->save();
			Session::flash('message', 'Thanks For Verifying Your Email Address!!!!');
		 	return view('auth.register')->with('user',$user);
		
		
  	   }
	  public function create_user()
		{
			DB::table('users')->insert([
					'firstname' =>Input::get('firstname'),
					'lastname' => Input::get('lastname'),
					'email' => Input::get('email'),
					'password' => bcrypt(Input::get('password')),
					'relationship_to_child' => Input::get('relationship_to_child'),
					'phone_no_1' => Input::get('mobile_no')
											]);
	   
			$sch_id=DB::table('schools')->select('id')->where('school_names',Input::get('school'))->first();
			$room_id=DB::table('teachers_rooms')->select('id')->where([['school_id',$sch_id->id],['room_no',Input::get('classroom')]])->first();
			$user_id=DB::table('users')->select('id')->where('email',Input::get('email'))->first();
			DB::table('child_info')->insert([
					'sch_id' => $sch_id->id,
					'users_id' => $user_id->id,
					'teacher_room_id' => $room_id->id,
					'childs_firstname' => Input::get('childs_firstname'),
					'childs_lastname' =>Input::get('childs_lastname')
											]);
			Session::flash('message', 'Successfully Registered, Thanks...Login Here!!!!');
	    	return Redirect::to('/login');
		}
		
}
