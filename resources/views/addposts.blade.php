@extends('layouts.app')

@section('content')

@include('layouts/header')

<p style="color:green;">
  {{ \Session::get('success') }}
</p>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="form-inline" action="{{ url('/')}}/createpost" method="post" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" value="0">
    <div class="form-group">
      <label class="sr-only" for="email">Title</label>
      <input type="text" name="title" value="" class="form-control" placeholder="Title">
    </div>

    <div class="form-group">
      <label class="sr-only" for="email">Description</label>
      <textarea name="description" class="form-control" placeholder="Description"></textarea>
    </div>
    <div class="form-group">
      <label class="sr-only" for="email">Select Image</label>
      <input type="file" name="image" value="" class="form-control">
    </div>

    <button type="submit" class="btn btn-default">Save</button>

  </form>


  @include('layouts/footer')

@endsection