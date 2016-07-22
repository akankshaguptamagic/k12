@extends('apppage')

@section('content')
	 




<style type="text/css">
.bs-example{
	margin:10px;
	
}
</style>

<!--Navigation start-->
<section class="content">	
	
				
<div class="container">
  <div class="bs-example">
  <div class="btn-group">
  <form action="" method="post"> 
  
  <?php
			$id = DB::table('users')
           				 ->join('child_info', 'child_info.users_id', '=','users.id')
						->where('email','=',Auth::user()->email)
           			 ->select('child_info.id')->get();
					 
 foreach($id as $id)
 {

 $name=DB::table('child_info')->select('id','childs_firstname','childs_lastname')->where('id',$id->id)->first();

	?>
	
 <a href="{{ URL::to('/childstatus',array($name->id))}}"><button type="button"  name="getid" class="btn btn-primary"  value="{{ $name->id }}">
	{{ $name->childs_firstname}} {{ $name->childs_lastname}} 
	</button></a>
	 
	<?php
	}
		
	?>
	
  </form>
  </div>
</div>
</div>
<!--Navigation end-->
<!-- Modal -->

    <!-- Button HTML (to Trigger Modal) -->
 
   
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
			<div class="modal-body">
			<a href=""> <img src="../../../apppage/dist/img/cancel201.gif" data-dismiss="modal" align="right"></a>
               <form action="{{ url('/addchild') }}" method="post">
			   {!! csrf_field() !!}
                <div>
                   <label>First Name</label><input  style="width:60%" type="text" name="sec_child_firstname" placeholder="First Name:" value="" required>
                </div>
                <div >
                 <label>Last Name</label> <input style="width:60%" type="text" name="sec_child_lastname" placeholder="Last Name" value="" required >
                </div>
                <div>
                 <label>Relation</label>
				 <select style="width:60%" name="sec_child_relation" required>
				 <option selected="selected" value="">Please Select</option>
				 <option value="Father">Father</option>
				 <option value="Mother">Mother</option>
				 <option value="Sister">Sister</option>
				 <option value="Brother">Brother</option>
				 <option value="Grandfather">Grandfather</option>Please Select
				 <option value="Grandmother">Grandmother</option>
				 </select> 
                </div>
				
				 <div>
                 <label>Class</label>
				 <select style="width:60%" name="sec_child_class" required>
				 <option selected="selected" value="">Please Select</option>
				 <option value="IA">IA</option>
				 <option value="IB">IB</option>
				 <option value="IC">IC</option>
				 
				 </select> 
                </div>
				
				<div class="box-footer clearfix">
			<a href="{{ url('/addchild')}}"> <button type="submit" class="btn btn-success" name="action" value="addnewchild">Add Child</button></a>
            </div>
				</form>
				</div>
            </div>
        </div>
    </div>

			
			
			
			
		 
			
			<!--POP UP END-->
          <div class="box box-info" style="width:60%">
            <div class="box-header">
             <!-- <i class="fa fa-envelope"></i>-->

              <h3 class="box-title"><span class = "glyphicon glyphicon-user"></span> Child Status</h3>
              <!-- tools box -->
              
              <!-- /. tools -->
            </div>
			
			<style>
			

label {
font-family:"Times New Roman", Times, serif;
font-size: 15px;
color: #333;
height: 10px;
width: 100px;
margin-top: 10px;
margin-left: 0px;
text-align: left;
clear: both;
}
.isa_success {
   color: #4F8A10;
   background-color: #DFF2BF; 
   width:60%; 
   margin-left:0px;
} 

			</style>
		 @if (Session::has('message'))
                <div id="alert_message" class="alert alert-success">{{ Session::get('message') }}</div>
        	 @endif	
            <div class="box-body"  >
			 
              <form action="{{ url('/update') }}" method="get">
			  
			   
                  <input  type="hidden" name="id"  value="{{ $data[0]->id}}">
                
                <div>
                   <label>First Name</label><input  style="width:60%" type="text" name="firstname" placeholder="First Name:" value="{{ $data[0]->childs_firstname }}">
                </div>
                <div >
                 <label>Last Name</label> <input style="width:60%" type="text" name="lastname" placeholder="Last Name" value="{{ $data[0]->childs_lastname }}">
                </div>
                <div>
                 <label>Relation</label>
				 <select style="width:60%" name="relation">
				 <option selected="selected" value="{{ $data[0]->relationship_to_child }}">{{ $data[0]->relationship_to_child }}</option>
				  <option value="Mother">Mother</option>
				 <option value="Father">Father</option>
				 <option value="Sister">Sister</option>
				 <option value="Brother">Brother</option>
				 <option value="Grandfather">Grandfather</option>
				 <option value="Grandmother">Grandmother</option>
				 </select> 
                </div>
				 <div >
                <label> School	</label>: {{ Session::get('blog.schoolname') }}
				</div>
				<div>
                 <label>Class</label>
				 <select style="width:60%" name="classroom">
				 <option selected="selected" value="{{ $classroom->room_no}}">{{ $classroom->room_no}}</option>
				 <option value="IA">IA</option>
				 <option value="IB">IB</option>
				 <option value="IC">IC</option>
				
				 </select> 
                </div>
				<div> <label>Class Teacher</label>:{{ $classroom->teachers_name}}</div>
				<div class="box-footer clearfix">
			  
             <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" name="" value="">Add New Child</button>
			 
			<button type="submit" class="btn btn-success" name="action" value="update">Update</button>
			<a href="{{ URL::to('/deletechild',array($data[0]->id))}}"><button type="button" class="btn btn-success" name="action" value="delete">Delete</button></a>
            </div>
				</form>
                </div>
             
         
			  
			</div>
			</section>
			  <script type="text/javascript">
                window.setTimeout(function() {
                $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
              });
            }, 3000);
			
			
			$(document).ready(function(){
	$('.open-modal').click(function(){
		$('#myModal').modal('show');
	});
   
});
                </script>
				
				
			
  @endsection