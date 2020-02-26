@extends('layouts.app')

@section('content')

@include('layouts/header')
  <p style="color:green;">
  {{ \Session::get('success') }}
</p>
      @foreach($posts as $post)
        <div class="col-sm-4">
          <div class="well">
          
          	 <a href="{{ url('post') }}/{{ $post->slug }}">Details</a>
              @if(Auth::user()->user_role!=3)
               <a href="{{ url('editpost') }}/{{ $post->slug }}">Edit</a>
           
            <a href="{{ url('delete') }}/{{ $post->slug }}">Delete</a>
            @endif
            
          	
            <p>{{ $post->title }}</p> 
           <!--  <p>{{$post->description }}</p>  -->
            <img src="{{ asset('uploads') }}/{{$post->featured_image}}" style="width: 191px; height: 70px;" />
          </div>
        </div>

        @endforeach

        <?php echo $posts->links(); ?>
     
     

@include('layouts/footer')

@endsection
