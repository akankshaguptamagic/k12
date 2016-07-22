@extends('layouts.main')

@section('content')


    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url ('/') }}">SCH<i class="fa fa-circle"></i><i class="fa fa-circle"></i>L PR<i class="fa fa-circle"></i>JECT</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url ('/') }}">HOME</a></li>
            <li><a href="{{ url ('/login') }}">LOGIN</a></li>
            <li class="active"><a href="{{ url ('/joinrequest') }}">REQUEST TO JOIN</a></li>
          </ul>    
        </div><!--/.nav-collapse -->
      </div>
    </div>
<br><br>
         @if ($errors->has())
                <div id="alert_message" class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>        
                    @endforeach
                </div>
         @endif

         @if (Session::has('message'))
                <div id="alert_message" class="alert alert-success">{{ Session::get('message') }}</div>
         @endif
    <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Request To Join!</div>
                <div class="panel-body">
    <form class="form-horizontal" role="form" method="post" action="{{ url('/') }}">
                 {!! csrf_field() !!}
                  
                  <div class="form-group">
                    <label  class="col-md-4 control-label"
                              for="email">Your Email</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" 
                            name="email" placeholder="Enter your email" required />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label"
                          for="firstname" >First Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control"
                            name="firstname" placeholder="Enter your first name" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label"
                          for="lastname" >Last Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control"
                            name="lastname" placeholder="Enter your last name" required/>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-4 control-label" for="school">School</label>
                      <div class="col-md-6">
                     <select class="form-control" id="school_id" name="school" required>
                        <option value="" selected>Select School</option>
                         @foreach($schools as $school)

                            <option value="{{ $school->id }}"> {{$school->school_names}}</option>

           @endforeach

                      </select>
                      </div>
                </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label"
                          for="childsfirstname" >Child's First Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control"
                            name="childs_firstname" placeholder="Enter your child's first name" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label"
                          for="childslastname" >Child's Last Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control"
                            name="childs_lastname" placeholder="Enter your child's last name" required/>
                    </div>
                  </div>
                <div class="form-group">
                      <label class="col-md-4 control-label" for="relationship">Relationship to Child</label>
                      <div class="col-md-6">
                      <select class="form-control" name="relationship_to_child" required>
                        <option value="" selected>Select Relationship</option>
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                        <option value="Brother">Brother</option>
                      </select>
                      </div>
                </div>
                  <div class="form-group">
                      <label class="col-md-4 control-label" for="classroom">Classroom</label>
                      <div class="col-md-6">
                      <select class="form-control" id="class_id" name="classroom" required>
                        <option value="" selected>Select Classroom</option>
                      
                      </select>
                      </div>
                </div>
				<div class="form-group">
                    <label class="col-md-4 control-label"
                          for="mobile_no" >Mobile Number</label>
                    <div class="col-md-6" id="mobile_no">
                        <input type="text" class="form-control"
                            name="mobile_no" id="mobile" placeholder="Enter your mobile number" maxlength="10" required/>
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="note" class="col-md-4 control-label">Note</label>
                      <div class="col-md-6">
                      <textarea class="form-control" rows="4" name="note" style="resize: none;" placeholder="(Optional) Enter any information that could help your school’s Admin to identify you, e.g. the classroom your second child is in."></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">     
                    <button type="submit" class="btn btn-success" >Submit</button>
                           </div>
                    </div>
  </form>
                  </div>
                
              

                <style type="text/css">
                  .alert {
                       width:750px; 
                       margin-left: 300px;   
                    }
                </style>

                <script type="text/javascript">
                window.setTimeout(function() {
                $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
              });
            }, 3000);
                </script>
<script>
                  



 $('#school_id').on('change', function(e){

    var cat_id = e.target.value;

       //ajax

       $.get('/dropdown?cat+id=' + cat_id, function(data){

           //success data
           $('#class_id').empty();

           $('#class_id').append('<option value="">Please select</option>');

           $.each(data, function(index, subcatObj){
           // console.log(subcatObj.room_no);

               $('#class_id').append('<option value"'+subcatObj.id+'">'
               + subcatObj.room_no + '</option');


           });


       });

////mobile number integer only validation




 




////////////////ends here




   });
                </script>
				
				
				 <script type="text/javascript">
$('#mobile').on('keypress',function(e){
        var deleteCode = 8;  var backspaceCode = 46;
        var key = e.which;
        if ((key>=48 && key<=57) || key === deleteCode || key === backspaceCode || (key>=37 &&  key<=40) || key===0)    
        {    
            character = String.fromCharCode(key);
            if( character != '.' && character != '%' && character != '&' && character != '(' && character != '\'' ) 
            { 
                return true; 
            }
            else {

             return false; }
         }
         else   { 
            alert('Please Input Numbers Only');

          return false; }
    });
 </script>
                </div>
                </div>
                </div>
                </div>
                

                @endsection