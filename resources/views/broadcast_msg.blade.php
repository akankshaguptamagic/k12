@extends('apppage')
@section('content')
<script src="{{asset('assets/js/jquery.timers-1.0.0.js')}}"></script>
<script src="{{asset('assets/js/jquery-1.2.6.min.js')}}"></script>
<style>
#ChatBig{width:700px;height:470px;border-left: solid 1px lightgray;border-right: solid 1px lightgray;border-top: solid 1px lightgray;border-bottom: solid 1px lightgray;margin:20px; }
#ChatMessages {width: 700px;height: 470px;padding-left: 20px;padding-top: 10px;padding-right: 20px;text-align: justify;}
#ChatText{width:495px;height:48px;}
#ChatText:focus{outline:none;}
</style>
<section class="content-header">
  <h1> Message
    <!--MAIN CONTENT WILL BE HERE! -->
  </h1>
  <ol class="breadcrumb" style="padding-right:250px">
    <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Message</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-10">
      <div id="ChatBig">
        <div id="ChatMessages" style="overflow:auto;padding-bottom:auto;"></div>
        <br/>
        <div class="col-lg-12">
          <div align="left">
            <textarea  id="text"   style="width:100%;float:left;"></textarea>
            <input type="hidden"  id="room_id" value="{{ $class_id }}">
            <input type="hidden"  id="group_id" value="{{$group_id}}">
            <input type="hidden"  id="sch_id" value="{{ Session::get('blog.sch_id') }}">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2" style="border:2px solid black; margin-top:20px">
      <div style="height:470px">
        <p><b>User's</b></p>
        @foreach($data as $ab)
        
        {{$ab->firstname}}  {{$ab->lastname}} <br/>
        @endforeach </div>
    </div>
  </div>
</section>
<script>
var username;

$(document).ready(function()
{

//alert('room_id');
   pullData();
   $(document).keydown(function(e) {
    if (e.keyCode == 13)
		{
            sendMsg();
			pullData();
        }
    });
});

function pullData()
{
	 retrieveMessages();
     setTimeout(pullData,3000);
}

function retrieveMessages()
{
var room_id = $('#room_id').val();
var group_id=$('#group_id').val();
  $.get('/retrieveMessages', {room_id: room_id,group_id: group_id}, function(data)
      {
	    if ((data.length > 0) )
		 {
		   $("#ChatMessages").html("");
		   $('#ChatMessages').append('<br><div>'+data+'</div><br>');
		 }	
     });
}


function sendMsg()
{
   
    var text = $('#text').val();
	var room_id = $('#room_id').val();
	var sch_id = $('#sch_id').val();
	var group_id = $('#group_id').val();
	console.log(room_id);
	
    if (text.length > 0)
    {
		$('#text').val('');
		$.get('/sendMsg', {text:text,room_id:room_id,sch_id:sch_id,group_id:group_id}, function()
        {
       });	
    } 
	else
	{
		alert('Please Enter Text Message');
	}
}






</script>
@endsection 