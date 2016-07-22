@extends('layouts.main')

@section('content')
<body>

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
            <li class="active"><a href="{{ url ('/') }}">HOME</a></li>
            <li><a href="{{ url ('/login') }}">LOGIN</a></li>
            <li><a href="{{ url ('/joinrequest') }}">REQUEST TO JOIN</a></li>
          </ul>
            
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div id="headerwrap">
        <div class="container">
            <div class="row centered">
                <div class="col-lg-8 col-lg-offset-2">
                <h1>Interaction Between <b>Teachers, Parents</b> and <b> Students</b></h1>
                 <h2>was never this easy before.</h2>
                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- headerwrap -->


    <div class="container w">
        <div class="row centered">
            <br><br>
            <div class="col-lg-4">
                <i class="fa fa-heart"></i>
                <h4>DESIGN</h4>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even believable.</p>
            </div><!-- col-lg-4 -->

            <div class="col-lg-4">
                <i class="fa fa-laptop"></i>
                <h4>BOOTSTRAP</h4>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even believable.</p>
            </div><!-- col-lg-4 -->

            <div class="col-lg-4">
                <i class="fa fa-trophy"></i>
                <h4>SUPPORT</h4>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even believable.</p>
            </div><!-- col-lg-4 -->
        </div><!-- row -->
        <br>
        <br>
    </div><!-- container -->


    <!-- PORTFOLIO SECTION -->
    <div id="dg">
        <div class="container">
            <div class="row centered">
                <h4>LATEST WORKS</h4>
                <br>
                <div class="col-lg-4">
                    <div class="tilt">
                    <a href="#"><img src="../../../assets/img/p01.png" alt=""></a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="tilt">
                    <a href="#"><img src="../../../assets/img/p03.png" alt=""></a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="tilt">
                    <a href="#"><img src="../../../assets/img/p02.png" alt=""></a>
                    </div>
                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- DG -->


    <!-- FEATURE SECTION -->
    <div class="container wb">
        <div class="row centered">
            <br><br>
            <div class="col-lg-8 col-lg-offset-2">
                <h4>WE CREATE FIRST CLASS DESIGN</h4>
                <p>By being true to the brand we represent, we elevate the audiences’ relationship to it. Like becomes love becomes a passion. Passion becomes advocacy. And we see the brand blossom from within, creating a whole story the audience embraces. That’s when the brand can truly flex its muscles.</p>
            <p><br/><br/></p>
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-10 col-lg-offset-1">
                <img class="img-responsive" src="assets/img/munter.png" alt="">
            </div>
        </div><!-- row -->
    </div><!-- container -->


    <div id="lg">
        <div class="container">
            <div class="row centered">
                <h4>OUR AWESOME CLIENTS</h4>
                <div class="col-lg-2 col-lg-offset-1">
                    <img src="../../../assets/img/c01.gif" alt="">
                </div>
                <div class="col-lg-2">
                    <img src="../../../assets/img/c02.gif" alt="">
                </div>
                <div class="col-lg-2">
                    <img src="../../../assets/img/c03.gif" alt="">
                </div>
                <div class="col-lg-2">
                    <img src="../../../assets/img/c04.gif" alt="">
                </div>
                <div class="col-lg-2">
                    <img src="../../../assets/img/c05.gif" alt="">
                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- dg -->
    
    
    <div id="r">
        <div class="container">
            <div class="row centered">
                <div class="col-lg-8 col-lg-offset-2">
                    <h4>WE ARE STORYTELLERS. BRANDS ARE OUR SUBJECTS. DESIGN IS OUR VOICE.</h4>
                    <p>We believe ideas come from everyone, everywhere. At BlackTie, everyone within our agency walls is a designer in their own right. And there are a few principles we believe—and we believe everyone should believe—about our design craft. These truths drive us, motivate us, and ultimately help us redefine the power of design.</p>
                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div><! -- r wrap -->
    
    
    <!-- FOOTER -->
    <div id="f">
        <div class="container">
            <div class="row centered">
                <a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-dribbble"></i></a>
        
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- Footer -->



    <!-- MODAL FOR CONTACT -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Request to Join</h4>
          </div>
          <div class="modal-body">
                 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
                @endif
                <form class="form-horizontal" role="form" method="post" action="{{ url('/') }}">
                 {!! csrf_field() !!}
                  
                  <div class="form-group">
                    <label  class="col-sm-4 control-label"
                              for="email">Your Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" 
                        name="email" placeholder="Enter your email" required />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label"
                          for="firstname" >First Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"
                            name="firstname" placeholder="Enter your first name" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label"
                          for="lastname" >Last Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"
                            name="lastname" placeholder="Enter your last name" required/>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-4 control-label" for="school">School</label>
                      <div class="col-sm-8">
                      <select class="form-control" name="school" required>
                        <option value="" selected>Select School</option>
                        <option value="DPS">DPS</option>
                        <option value="DAV">DAV</option>
                        <option value="ABC">ABC</option>
                      </select>
                      </div>
                </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label"
                          for="childsfirstname" >Child's First Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"
                            name="childs_firstname" placeholder="Enter your child's first name" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label"
                          for="childslastname" >Child's Last Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"
                            name="childs_lastname" placeholder="Enter your child's last name" required/>
                    </div>
                  </div>
                <div class="form-group">
                      <label class="col-sm-4 control-label" for="relationship">Relationship to Child</label>
                      <div class="col-sm-8">
                      <select class="form-control" name="relationship_to_child" required>
                        <option value="" selected>Select Relationship</option>
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                        <option value="Brother">Brother</option>
                      </select>
                      </div>
                </div>
                  <div class="form-group">
                      <label class="col-sm-4 control-label" for="classroom">Classroom</label>
                      <div class="col-sm-8">
                      <select class="form-control" name="classroom" required>
                        <option value="" selected>Select Classroom</option>
                        <option value="Room 1">Room 1</option>
                        <option value="Room 2">Room 2</option>
                        <option value="Room 3">Room 3</option>
                      </select>
                      </div>
                </div>
                  <div class="form-group">
                      <label for="note" class="col-sm-4 control-label">Note</label>
                      <div class="col-sm-8">
                      <textarea class="form-control" rows="4" name="note" style="resize: none;" placeholder="(Optional) Enter any information that could help your school’s Admin to identify you, e.g. the classroom your second child is in."></textarea>
                      </div>
                    </div>
                  </div>
                   <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
                </form>

            <style type="text/css">
            .modal-body {
              max-height: calc(100vh - 210px);
              overflow-y: auto;
             }
             </style>
            
           
          </div>
          </div>
          </div>


          
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
            
@endsection
