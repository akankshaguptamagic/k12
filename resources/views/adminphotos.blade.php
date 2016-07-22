<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Create Photo Album</title>

		<link rel="icon" type="image/png" href="icons/favicon.png">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

		<script type="text/javascript" src="https://raw.githubusercontent.com/markusslima/bootstrap-filestyle/master/src/bootstrap-filestyle.js"></script>
	</head>

	<body>
		<div class="container" style="margin-top: 30px; margin-bottom: 30px">
			<div class="row">
				<div class="span12">
					<h2 style="text-align: center;">Upload School Photos</h2>
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
					<div class="well">
						<form role="form" action="{{url('/uploadphotos')}}" enctype="multipart/form-data" method="post">
						{!! csrf_field() !!}
							<h3>Upload School Photos</h3>
							<hr>
							<div class="row">
  								<div class="col-md-6">
									<div class="form-group">
										 <select class="form-control" name="school" required>
                        						<option value="" selected>Select School</option>
						                        <option value="1">School 1</option>
						                        <option value="2">School 2</option>
						                        <option value="3">School 3</option>
                      					</select>
									</div>
									<div class="form-group">
										<input type="text" name="album_name" class="form-control" id="album_name" placeholder="Enter album name" required="">
									</div>
									<div class="form-group">
										<input type="file" name="photos[]" id="photos" multiple="multiple" required="">
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-success">
											<span class="glyphicon glyphicon-ok"></span> Upload
										</button>
									</div>
								</div>
								<div class="col-md-2">
									
								</div>
							</div>
						</form>
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
	</body>
</html>