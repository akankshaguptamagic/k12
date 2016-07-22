<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
	protected $fillable = ['email','firstname', 'lastname', 'school', 'childs_firstname', 'childs_lastname', 'relationship_to_child', 'classroom','mobile_no', 'note','email_confirmed','email_confirmation_code'

	];
	
    protected $table = 'join_requests';

     public static $rules = array(                               // just a normal required validation
        'email'            => 'required|email|unique:join_requests',   
        'firstname'        => 'required',                      // required and must be unique in the join_requests table
        'lastname'         => 'required',
        'school'           => 'required',
        'childs_firstname' => 'required',
        'childs_lastname'  => 'required',    
        'relationship_to_child' => 'required',
        'classroom'        =>  'required',   
		'mobile_no'        =>  'required'       
                                                                  // required and has to match the password field
    );
}
