<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class child_info extends Model
{
     protected $fillable = ['sch_id', 'teacher_room_id', 'users_id', 'childs_firstname', 'childs_lastname'];
	
    protected $table = 'child_info';

     public static $rules = array(                               // just a normal required validation
        'sch_id'  => 'required',   
        'teacher_room_id'        => 'required',                      
        'users_id'    => 'required',
        'childs_firstname' => 'required|Alpha',
        'childs_lastname'  => 'required|Alpha',    
        
                                                                 
    );
}
