<?php

namespace App\Http\Controllers;
use DateTime;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Auth; 
use Session;
use DB;
use Hash;
use App\JoinRequest;
use Illuminate\Support\Facades\Input;
use Redirect;
use App\TeachersRoom;
use App\User;
use mPDF;

use Illuminate\Support\Facades\Validator;

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
    public function ShowAppPage()
    {
		$result=array();
		$id = DB::table('users')->select('id')->where('email', Auth::user()->email)->first();
		
		$data = DB::table('users')
            ->join('child_info', 'child_info.users_id', '=','users.id')
            ->where('users.id','=',$id->id)
            ->select('firstname','lastname','childs_firstname','childs_lastname','sch_id','teacher_room_id')
            ->get();
			
		$sec_data=DB::table('schools')->select('school_names')->where('id',$data[0]->sch_id)->first();
		
		$third_data=DB::table('teachers_rooms')->select('room_no','teachers_name')->where('id',$data[0]->teacher_room_id)->first();
		
		$gr_data=DB::table('social_groups')->select('social_groups.id','group_name')
            ->join('child_info', 'child_info.grp_id', '=','social_groups.id')
            ->where(['child_info.sch_id'=>$data[0]->sch_id,'users_id'=>Auth::user()->id])->get();
	 
	 foreach($data as $cc)
	 {
	 
	
	$r=DB::table('teachers_rooms')->select('id','room_no','teachers_name')->where('id',$cc->teacher_room_id)->orderBy('id','desc')->first() ;
	
	
	array_push($result,
      array('id'=>$r->id,
      'room_no'=>$r->room_no,
	  'teachers_name'=>$r->teachers_name
     ));
	
	 }
		
		$final=array('parent_first_name'=>$data[0]->firstname,'parent_last_name'=>$data[0]->lastname,'schoolname'=>$sec_data->school_names,'class'=>$third_data->room_no,'teacher_name'=>$third_data->teachers_name,'stu_first_name'=>$data[0]->childs_firstname,'stu_last_name'=>$data[0]->childs_lastname,'room'=>$result,'group'=>$gr_data,'sch_id'=>$data[0]->sch_id);
		
		\Session::put('blog',$final);
		$events=DB::table('events')->select('title','description','start','backgroundColor','borderColor')->where('school_id',$data[0]->sch_id)->get();	
	 	return view('calender')->with('content',json_encode($events));
		
	
	
    }
   
   
    public function childstatus()
	{
	//it counts childs and create tabs in child blade..
							
							
			$result = DB::table('users')
           		 ->join('child_info', 'child_info.users_id', '=','users.id')
			  ->where('email','=',Auth::user()->email)
           	 ->select('child_info.id','sch_id','childs_firstname','childs_lastname','relationship_to_child','teacher_room_id',DB::raw('count(users_id) as child'))
			->get();
									
	     $classroom=DB::table('teachers_rooms')->select('room_no','teachers_name')->where([['id',$result[0]->teacher_room_id],['school_id',$result[0]->sch_id]])->first();
							
		 return view('childstatus')->with('data',$result)->with('classroom',$classroom);
					 
}
	
	
	public function addchild()
	{
		$sch_id=DB::table('schools')->select('id')->where('school_names', Session::get('blog.schoolname'))->first();
			$parent_id=DB::table('users')->select('id')->where('email', Auth::user()->email)->first();
			$class_id=DB::table('teachers_rooms')->select('id')->where([['school_id',$sch_id->id],['room_no',$_REQUEST['sec_child_class']]])->first();
			DB::table('child_info')->insert([
    			'sch_id' => $sch_id->id,
    			'users_id' => $parent_id->id,
				'teacher_room_id' => $class_id->id,
				'childs_firstname' => $_REQUEST['sec_child_firstname'],
				'childs_lastname' => $_REQUEST['sec_child_lastname']
										]);
			 return Redirect::back();
	}
	
	public function filldata($id)
	{
				$result = DB::table('users')
           					->join('child_info', 'child_info.users_id', '=','users.id')
							 ->where([['email',Auth::user()->email],['child_info.id',$id]])
           					 ->select('child_info.id','sch_id','childs_firstname','childs_lastname','relationship_to_child','teacher_room_id')
							 ->get();
								
		$classroom=DB::table('teachers_rooms')->select('room_no','teachers_name')->where([['id',$result[0]->teacher_room_id],['school_id',$result[0]->sch_id]])->first();
		 return view('childstatus')->with('data',$result)->with('classroom',$classroom);
	
	}
	
	public function updatechild()
	{
			$id=DB::table('child_info')->select('sch_id')->where('id',Input::get('id'))->first();
			
			$class_id=DB::table('teachers_rooms')->select('id','teachers_name')->where([['school_id',$id->sch_id],['room_no',Input::get('classroom')]])->first();
				
				$final=array(
				'childs_firstname'=>Input::get('firstname'),
				'childs_lastname'=>Input::get('lastname'),
				'teacher_room_id'=>$class_id->id
				);
				
				DB::table('child_info')
           		 ->where('id', Input::get('id'))
           		 ->update($final);
				 
				 DB::table('users')
           		 ->where('email', Auth::user()->email)
           		 ->update(['relationship_to_child'=>Input::get('relation')]);
				 Session::flash('message', 'Data Has Been Updated Successfully!');
				return Redirect::back();
			}	
			
		public function deletechild($id)
			{
				DB::table('child_info')->where('id', $id)->delete();
				return Redirect::to('childstatus');
			}		
		
		public function school_directory()
		{ 
			$id = DB::table('users')->select('id')->where('email',Auth::user()->email)->first();
			$sch_id = DB::table('child_info')->select('sch_id')->where('users_id',$id->id)->first();
			$room=DB::table('teachers_rooms')->select('room_no','id')->where('school_id',$sch_id->sch_id)->get();
			$result = DB::table('users')
           					->join('child_info', 'child_info.users_id', '=','users.id')
							 ->where('teacher_room_id',$room[0]->id)
           					 ->select('users.id','firstname','lastname','childs_firstname','childs_lastname')
							 ->get();			
			 $stu_room=DB::table('teachers_rooms')->select('room_no')->where('id',$room[0]->id)->first();
			 return view('school_directory')->with('room',$room)->with('user_info',$result)->with('stu_room',$stu_room);
		}
		public function showdata($id)
		{
			$user_id = DB::table('users')->select('id')->where('email',Auth::user()->email)->first();
			$sch_id = DB::table('child_info')->select('sch_id')->where('users_id',$user_id->id)->first();
			$room=DB::table('teachers_rooms')->select('room_no','id')->where('school_id',$sch_id->sch_id)->get();
			$result = DB::table('users')
           					->join('child_info', 'child_info.users_id', '=','users.id')
							 ->where('teacher_room_id',$id)
           					 ->select('users.id','firstname','lastname','childs_firstname','childs_lastname')
						 ->get();
					
			 $stu_room=DB::table('teachers_rooms')->select('room_no')->where('id',$id)->first();
			 return view('school_directory')->with('room',$room)->with('user_info',$result)->with('stu_room',$stu_room);
		}
		public function getdata($id)
		{
			$info=DB::table('users')->select('phone_no_1','street','city','country','email','firstname','lastname','relationship_to_child')->where('id',$id)->first();
			$address=$info->street." ".$info->city.",".$info->country;
			$child_info = DB::table('child_info')
           					->join('teachers_rooms', 'child_info.teacher_room_id', '=','teachers_rooms.id')
							 ->where('child_info.users_id',$id)
           					 ->select('childs_firstname','childs_lastname','teachers_name','room_no')
							 ->get();
			$totalchild= DB::table('child_info')->select(DB::raw('count(users_id) as child'))->where('child_info.users_id',$id)->get();
			$final=array('phone_no_1'=>$info->phone_no_1,'address'=>$address,'email'=>$info->email,'firstname'=>$info->firstname,'lastname'=>$info->lastname,'relation'=>$info->relationship_to_child,'total_child'=>$totalchild[0]->child);
		
			 $finalarray=array_merge($final,$child_info);
			 return response()->json(json_encode($finalarray));
			
		}
		
		public function printpdf()
		{
			$mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0);
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
			$html = "<html>
			<body>
				<h1>Staff Details</h1>
				<table>
				<tr><th>Name</th><th>Designation</th></tr>
				<tr><th>Seema</th><th>Principal</th></tr>
				<tr><th>Rekha</th><th>Wise Principal</th></tr>
				<tr><th>Rishabh</th><th>Teacher</th></tr>
				<tr><th>Tarun</th><th>Teacher</th></tr>
				<tr><th>Payal</th><th>Teacher</th></tr>
				</table>
			</body>
			</html>";
			$mpdf->WriteHTML($html);
			$orderPdfName = "order-".$singleOrder[0]['display_name'];
			$mpdf->Output("school_detail.pdf",'I');
			header('Content-type: application/pdf');
			header("Content-Disposition: attachment; filename=school_detail.pdf");
		}
	public function getevent()
		{
				$events = array();
				$e = array();
				$e['title'] = "hello";
				$e['start'] ="2015-01-24T16:00:00+04:00";
				$e['backgroundColor'] = "#f56954";
				$e['borderColor'] =  "#f56954";
				array_push($events, $e);
				return response()->json(json_encode($events));
		}
		

	
	public function upload_profile(){
    
         $image = Input::file('profile_picture');
         $rules = array(
         'profile_picture' => 'required|image',
        
    );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
           return Redirect::action('HomeController@personal_settings')->withErrors($validator);
        }
        $user = Auth::user();
        $imagename = $user->id . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path() . '/profile_pictures';
        if(!$image->move($destinationPath, $imagename)) {
            return Redirect::action('HomeController@personal_settings')->withMessage("Oops! Image Upload Failed!");
        }
        $user->profile_picture = $imagename;
        $user->save();
        return Redirect::action('HomeController@personal_settings')->withMessage("Image Uploaded Successfully!");
        
    }
	
	 public function personal_settings()
	{
        
        $data = User::all();
        $user = Auth::user();
        
        $data = DB::table('users')
            ->join('child_info', 'child_info.users_id', '=','users.id')
            ->where('users.id','=',$user->id)
            ->select('firstname','lastname','childs_firstname','childs_lastname','sch_id','teacher_room_id')
            ->get();
    
        $sec_data=DB::table('schools')->select('school_names')->where('id',$data[0]->sch_id)->first();
        
        $third_data=DB::table('teachers_rooms')->select('room_no','teachers_name')->where('id',$data[0]->teacher_room_id)->first();
        
        $final=array('first_name'=>$data[0]->firstname,'last_name'=>$data[0]->lastname,'school_name'=>$sec_data->school_names,'room_no'=>$third_data->room_no,'teacher_name'=>$third_data->teachers_name,'childs_first_name'=>$data[0]->childs_firstname,'childs_last_name'=>$data[0]->childs_lastname);
        

        return view('account_settings', ['data' => $data , 'child' => $final]);
    }
	
	
	 public function changePassword() 
	 {
		$user = Auth::user();
		$rules = array(
			'old_password' => 'required|alphaNum|min:6',
			'password' => 'required|alphaNum|min:6|confirmed'
		);

    	$validator = Validator::make(Input::all(), $rules);

    	if ($validator->fails()) 
		{
			return Redirect::action('HomeController@personal_settings',$user->id)->withErrors($validator);
		} 
		else 
		{
			if (!Hash::check(Input::get('old_password'), $user->password)) 
			{
				return Redirect::action('HomeController@personal_settings',$user->id)->withErrors('Your old password does not match!');
			}
			else
			{
				$user->password = Hash::make(Input::get('password'));
				$user->save();
				return Redirect::action('HomeController@personal_settings',$user->id)->withMessage("Your password have been changed!");
			}
		}
	  }
	  
	  
	  public function broadcast_message()
	{
	  return view('broadcast_msg');
	}
	
	
		public function show_user($id)
	   {
	   $data = DB::table('users')
            ->join('child_info', 'child_info.users_id', '=','users.id')
            ->where('child_info.teacher_room_id','=',$id)
            ->select('firstname','lastname','teacher_room_id')
            ->get();
			$class_id=$data[0]->teacher_room_id;
   
      return view('broadcast_msg')->with(['data'=>$data,'class_id'=>$class_id,'group_id'=>NULL]);
           
			
	    }
		
		
		
		
		public function group_user($id)
	   {
	   $data = DB::table('users')
            ->join('child_info', 'child_info.users_id', '=','users.id')
            ->where('child_info.grp_id','=',$id)
            ->select('firstname','lastname','grp_id')
            ->get();
	
			$group_id=$data[0]->grp_id;
   
      return view('broadcast_msg')->with(['data'=>$data,'class_id'=>NULL,'group_id'=>$group_id]);
           
			
	    }
	
	
	
	 public function retrieveMessages()
    {
	 $group_id = Input::get('group_id');
	$room_id = Input::get('room_id');
			if($group_id==''){
			$id=DB::table('messages')->select('user_id','message')->where('class_id',$room_id)->get();
		}else{
	
		$id=DB::table('messages')->select('user_id','message')->where('group_id',$group_id)->get();
		}
		
	   foreach($id as $data)
		{
		  $info=DB::table('users')->select('firstname','lastname')->where('id',$data->user_id)->first();
		  echo '<b>'.$info->firstname.'</b>'.' '.'<b>'.$info->lastname.'</b>'.":   ".$data->message; 
		  echo "<br>"; 
		}	
	}
	
	public function sendMsg()
      {
	 	
         $text = Input::get('text');
		 $school_id = Input::get('sch_id');
		 $room_id = Input::get('room_id');
		 $group_id = Input::get('group_id');
		 if($group_id==''){$group_id=NULL;}
		 if($room_id==''){$room_id=NULL;}
		 
		 $id=DB::table('users')->select('id','firstname','lastname')->where('email',Auth::user()->email)->first();
		
		 DB::table('messages')->insert([
    			'user_id' => $id->id,
    			'class_id' => $room_id,
				'school_id' => $school_id,
				'group_id' => $group_id,
				'message' => $text
					]);
	}
	
}
