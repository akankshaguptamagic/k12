 @extends('layouts.app_main')
 @section('content')
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Announcements
                                     <!--MAIN CONTENT WILL BE HERE! -->
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Announcements</li>
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
        <div class="col-md-8 col-md-offset-0" id="content">
          
           <h1>Announcement 1</h1>
           <h1>Announcement 2</h1>
           <h1>Announcement 3</h1>
           <h1>Announcement 4</h1>
           <h1>Announcement 5</h1>
           {{ $announce_data->description }}
                          
          
           <?php
           $a = $announce_data->date;
           $timestamp = strtotime($a);
           $day = date('l', $timestamp);
           echo $day;
           ?>
              

                <script type="text/javascript">
                window.setTimeout(function() {
                $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
              });
            }, 3000);
                </script>
                
                <style type="text/css">
                	#content h1{
                		text-align: center;
                     }
                	.alert {
                  	   margin-left: 20px;
                       width: 746px;
                    }
                </style>

                </div>
                </div>
                </div>
                </div>
                </div>
            </div><!-- /.col -->
            
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b>1.0
        </div>
        <strong>Copyright &copy; 2016 <a href="http://gbusolutions.com">GBU Solutions</a>.</strong> All rights reserved.
      </footer>
      @endsection