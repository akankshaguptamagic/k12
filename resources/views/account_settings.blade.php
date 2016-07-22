@extends('apppage')

@section('content')

 <!-- Content Wrapper. Contains page content -->
     
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Account Settings
                                     <!--MAIN CONTENT WILL BE HERE! -->
            
          </h1>
          <ol class="breadcrumb" style="padding-right:200px">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Account Settings</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              
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
        <div class="col-md-8 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Basic Info!</div>
                <div class="panel-body">
    <form class="form-horizontal" role="form" method="post" action="{{ url('/') }}">
                 {!! csrf_field() !!}
                  
                  <div class="form-group">
                    <label  class="col-md-4 control-label"
                              for="email">Profile Picture</label>
                    <div class="col-md-6">
                    <img src="{{ asset('profile_pictures/' . Auth::user()->profile_picture) }}" class="img-circle" height="42" width="42" alt="User Image">
                        <a data-toggle="modal" data-target="#myModal2" href="#myModal2" class="btn btn-link" role="button" style="text-decoration:none">Change</a>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label"
                          for="firstname" >First Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control"
                            name="firstname" value="{{ Auth::user()->firstname }}" required/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label"
                          for="firstname" >Last Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control"
                            name="lastname" value="{{ Auth::user()->lastname }}" required/>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label  class="col-md-4 control-label"
                              for="email">Your Email</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" 
                            name="email" value="{{ Auth::user()->email }}" readonly />
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-md-4 control-label"
                              for="email">Password</label>
                    <div class="col-md-6">
                        <a data-toggle="modal" data-target="#myModal" href="#myModal" class="btn btn-link" role="button" style="text-decoration:none">Change Password</a>
                    </div>
                  </div>
                   <div class="form-group">
                    <label  class="col-md-4 control-label"
                              for="email">Phone 1</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" 
                            name="text" placeholder="Enter your phone no." required />
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-md-4 control-label"
                              for="email">Phone 2</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" 
                            name="text" placeholder="Enter your phone no." required />
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-4 control-label"
                          for="childsfirstname" >Street</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control"
                            name="childs_firstname" placeholder="Enter your street" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label"
                          for="childslastname" >City</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control"
                            name="childs_lastname" placeholder="Enter your city" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label"
                          for="childslastname" >State</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control"
                            name="childs_lastname" placeholder="Enter your state" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label"
                          for="childslastname" >Zip</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control"
                            name="childs_lastname" placeholder="Enter your zipcode" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label"
                          for="childslastname" >Country</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control"
                            name="childs_lastname" placeholder="Enter your country" required/>
                    </div>
                  </div>
                
                 
                    <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">     
                    <button type="submit" class="btn btn-success" >Save</button>
                           </div>
                    </div>
</form>
                  </div>
                
                

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Change Password</h4>
          </div>
          <div class="modal-body">
  
                <form class="form-horizontal" role="form" method="post" action="{{ url('app/settings/personal/change_password') }}">
                 {!! csrf_field() !!}
                  
                  <div class="form-group">
                    <label  class="col-sm-4 control-label"
                              for="email">Old Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" 
                        name="old_password" placeholder="Enter your old password" required />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label"
                          for="firstname" >New Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control"
                            name="password" placeholder="Enter your new password" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label"
                          for="lastname" >Confirm New Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control"
                            name="password_confirmation" placeholder="Enter your new password again" required/>
                    </div>
                  </div>
                  <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                  </form>
                  </div>
                  </div>
                  </div>
                  </div>

                   <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Profile Picture</h4>
          </div>
          <div class="modal-body">
          <form class="form-horizontal" role="form" method="post" action="{{ url('app/settings/personal/change_picture') }}" enctype="multipart/form-data">
                 {!! csrf_field() !!}

                  <div class="form-group">
                    <label class="col-sm-4 control-label"
                          for="lastname">Select Photo</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control"
                            name="profile_picture" required/>
                    </div>
                  </div>
                  <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Submit</button>
                  </div>

          </form>
</div>
                  </div>
                  </div>
                  </div>

                <style type="text/css">
                  .alert {
                  	   margin-left: 20px;
                       width: 746px;
                    }

                </style>

                <script type="text/javascript">
                window.setTimeout(function() {
                $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
                $(this).remoe(); 
              });
            }, 3000);
                </script>

                </div>
                </div>
                </div>
                </div>
                </div>
            </div><!-- /.col -->
            
         <!-- /.row -->
        </section><!-- /.content -->
    

     
      @endsection