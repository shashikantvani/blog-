@extends('layouts.app')

@section('content')

@include('layouts/header')

<p style="color:green;">
  {{ \Session::get('success') }}
</p>

<input type="hidden" name="url" id="url" value="{{ url('/')}}">
 <div class="col-sm-9">
<form class="form-inline" action="{{ url('/')}}/addPermission" method="post">
@csrf
    <div class="form-group">
      <label class="sr-only" for="email">Select Role</label>
      <select class="form-control" id="role_id" name="role_id" onchange="getPermission()">
      	<option value="0">Please Select</option>
      	<option value="2"> Editor</option>
        <option value="3"> Reader</option>
      </select>
    </div>

     <table class="table">
    <thead>
      <tr>
        <th>Role</th>
        <th></th>
      </tr>
    </thead>
    <tbody id="role_body">
    </tbody>
</table>
    	
    <button type="submit" class="btn btn-default">Save</button>

  </form>


</div>

<script type="text/javascript">
	function getPermission(){

		var role=$('#role_id').val();
		var url=$('#url').val();
		url=url+'/getpermission/'+role;

 $.ajax({url: url, success: function(result){
     var result=JSON.parse(result);
  console.log(result);
    var html='';

    for(var i=0; i<result.data.length; i++){

    	html= html+'<tr><td>'+result.data[i].name+'</td>';
    	if(result.data[i].permission==1){
          html=html+'<td><input type="checkbox" name="permissions[]" value="'+result.data[i].id+'" checked/></td>';
    	}else{
            html=html+'<td><input type="checkbox" name="permissions[]" value="'+result.data[i].id+'"/></td>';
    	}

    	 html=html+'</tr>';
      
    }

    $('#role_body').html(html);

  }});

	}
</script>


@include('layouts/footer')

@endsection
