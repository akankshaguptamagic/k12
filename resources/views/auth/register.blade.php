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
          <a class="navbar-brand" href="#">SCH<i class="fa fa-circle"></i><i class="fa fa-circle"></i>L PR<i class="fa fa-circle"></i>JECT</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url ('/') }}">HOME</a></li>
            <li><a href="{{ url ('/login') }}">LOGIN</a></li>
          </ul>
            
        </div><!--/.nav-collapse -->
      </div>
    </div>
 @if (Session::has('message'))
                <div id="alert_message" class="alert alert-success" align="center" style="margin-top:50px">{{ Session::get('message') }}</div>
         @endif

<div class="container" style="padding-top:40px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/reg') }}">
                        {!! csrf_field() !!}
						
                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" readonly="">

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						<div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="lastname" value="{{ $user->lastname  }}" readonly="">

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						<div class="form-group">
                      		<label class="col-md-4 control-label" for="school">School</label>
							<div class="col-md-6">
                      		<select class="form-control" name="school"  readonly="">
								<option value="{{ $user->school }}" selected>{{ $user->school }}</option>
								<option value="Tagore Public School">Tagore Public School</option>
								<option value="Delhi Public School">Delhi Public School</option>
								<option value="Gd Goenka Public School">Gd Goenka Public School</option>
								<option value="St. Johns Public School">St. Johns Public School</option>
							 </select>
                      		</div>
					</div>
					 <div class="form-group">
                    <label class="col-md-4 control-label"
                          for="childsfirstname" >Child's First Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="childs_firstname"   value="{{ $user->childs_firstname }}"readonly=""/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label"
                          for="childslastname" >Child's Last Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="childs_lastname"  value="{{ $user->childs_lastname }}" readonly=""/>
                    </div>
                  </div>
                <div class="form-group">
                      <label class="col-md-4 control-label" for="relationship">Relationship to Child</label>
                      <div class="col-md-6">
                      <select class="form-control" name="relationship_to_child" readonly="">
                        <option value="{{ $user->relationship_to_child }}" selected>{{ $user->relationship_to_child }}</option>
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                        <option value="Brother">Brother</option>
                      </select>
                      </div>
                </div>
                  <div class="form-group">
                      <label class="col-md-4 control-label" for="classroom">Classroom</label>
                      <div class="col-md-6">
                      <select class="form-control" name="classroom" readonly="">
                        <option value="{{ $user->classroom }}" selected>{{ $user->classroom }}</option>
                        <option value="IA">IA</option>
                        <option value="IB">IB</option>
                        <option value="IC">IC</option>
						<option value="IIA">IIA</option>
						<option value="IIB">IIB</option>
						<option value="IIC">IIC</option>
                      </select>
                      </div>
                </div>
				<div class="form-group">
                    <label class="col-md-4 control-label"
                          for="mobile_no" >Mobile Number</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="mobile_no"   value="{{ $user->mobile_no }}" readonly=""/>
                    </div>
                  </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $user->email  }}" readonly="">

                               
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript">
                window.setTimeout(function() {
                $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
              });
            }, 3000);
                </script>
@endsection
