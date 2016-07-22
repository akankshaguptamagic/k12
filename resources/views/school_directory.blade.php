@extends('apppage')
@section('content') 
<style>
tbody:nth-child(odd) 
{
	background-color: #f2f2f2;
}
#popup
{
border: 1px solid gray;
}
</style>

<section class="content-header">
          <h1>
           School Directory 
		                         <!--MAIN CONTENT WILL BE HERE! -->
          </h1>
          <ol class="breadcrumb" style="padding-right:250px">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">School Directory</li>
          </ol>
        </section>
		<section class="content">
		
		 <button type="button" class="btn btn-primary" style="width:100px">Admin</button>
      	 <button type="button" class="btn btn-primary" style="width:100px">Staff</button>
      	<div class="btn-group open" onclick="return a()">
			<button type="button" class="btn btn-primary">Classrooms</button>
			<button id="dropdownmenu" type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></button>
			<ul class="dropdown-menu">
				@foreach($room as $rooms)
					<li><a href="{{ URL::to('/school_directory',array($rooms->id))}}">{{ $rooms->room_no }}</a></li>
				@endforeach
			</ul>
			
	</div>
		<button type="button" class="btn btn-primary">Invited Users</button>
		<div   style="padding-left:600px"><a href="{{ url('/printpdf')}}"><b>Print Directory As PDF</b></a></div>
  <div class="container"  align="left" style="width:75%; margin-left:-15px; padding-top:20px">
         <div class="panel panel-default" >
		  <div style="width:40%;float:right; padding-top:10px" class="input-group"> <span class="input-group-addon"><b>Search</b></span>
					 <input id="filter" type="text" class="form-control" placeholder="Type here...">
				</div>
            <div class="panel-heading" >
             <h5 style="width:30%"><b>ROOM  {{ $stu_room->room_no }}</b></h5>
			 
            </div>
            <div class="panel-body">
			<form>
			 {!! csrf_field() !!}
               <table id="table"  class="w3-table w3-bordered w3-striped  w3-hoverable">
                  <tbody>
				  	  <td><b>Parents</b></td>
					  <td><b>Students</b></td>
					 <td></td>
					 <td></td>
				  </tbody>
				 @foreach($user_info as $user)
				 <tbody class="searchable">
					  <td>{{ $user->firstname }} {{ $user->lastname }}</td>
					  <td>{{ $user->childs_firstname }} {{ $user->childs_lastname }}</td>
				 <td><a  data-toggle="modal" data-target="#myModal"  id="{{ $user->id }}" href="" class="btn-link" role="button" style="text-decoration:none">See Profile</a></td>
				
				  <td><a href="{{ URL::to('/chat',array('name'=>$user->firstname))}}">Send Message</a></td>
				  </tbody>
				  
				  @endforeach
             </table>
			 </form>
			 
			<br><br>
          </div>
        </div>
      </div>
<!--Pop up Start-->

<div data-keyboard="false" data-backdrop="static" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="removepop()">&times;</button>
			
            <h4 class="modal-title" id="myModalLabel"></h4><center><img id="waitimg" src="{{ asset('apppage/dist/img/loading_small.gif') }}"></center>
          </div>
		  
          <div class="modal-body">
  			<h5><b>Contact Info</b></h5>
		
              <table id="popup"  class="w3-table w3-bordered w3-striped  w3-hoverable">
                  <tbody>
				  <td><b>Email</b></td>
                  <td id="email"></td>
				  </tbody> 
				  <tbody>
                  <td><b>Phone</b></td>
				   <td id="phone"></td>
				  </tbody>
				  <tbody>
                  <td><b>Address</b></td>
				  <td id="address"></td>
				  </tbody>
				  
			</table>
			
			<h5><b>Your Roles</b></h5>
            <table id="popup1"  class="w3-table w3-bordered w3-striped  w3-hoverable">
                  <tbody id="childdata">
                  <th><b>Child Name</b></th>
				  
				   <th><b>ClassRoom</b></th>
				  
                  <th><b>Class Teacher</b></th>
				  
				  <th><b>Relation To Child</b></th>
				  </tbody>
				  
			</table>
                  </div>
                  </div>
                  </div>
                  </div>
				 <!--PopUp end-->	
     
     
     
		</section>
		<script type="application/json"></script>
		<script>
		
		$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
		
		
		
		$(document).on("click", ".btn-link", function () {
		$("#waitimg").show();
		 var myId = $(this).attr('id');
		 $(".modal-body #idtext").text( myId );
		$.ajax({
		type	:	'GET',
		url		:   '/getdata/' + $(this).attr('id'),
		async	:	false,
		dataType:	'json',
		data	: 	myId,
		success	:	function(data)
		{
		$("#waitimg").hide();
			var obj = JSON.parse(data);
			
			$("#myModalLabel").text( obj.firstname+" "+obj.lastname );	
			$(".modal-body #email").text( obj.email );	
			$(".modal-body #phone").text( obj.phone_no_1 );
			$(".modal-body #address").text( obj.address );
			for(i=0;i<obj.total_child;i++)
			{
			  var trHTML = '';
			  trHTML += '<tbody><td>' + obj[i].childs_firstname + " " + obj[i].childs_lastname + '</td><td>' + obj[i].room_no + '</td><td>' + obj[i].teachers_name+ '</td><td>' + obj.relation+ '</td></tbody>';
			  $('#popup1').append(trHTML);
			}
		}
		});
	});
function removepop()
{
	$('#myModalLabel').text(" ");
	$(".modal-body #email").text( " " );	
	$(".modal-body #phone").text( " " );	
	$(".modal-body #address").text( " " );	
	$('#popup1 td').remove();
		
}


</script>

@endsection




