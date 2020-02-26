@extends('layouts.app')

@section('content')

@include('layouts/header')

<p style="color:green;">
  {{ \Session::get('success') }}
</p>
<form class="form-inline" action="{{ url('/')}}/createpost" method="post" enctype="multipart/form-data">
@csrf

<input type="hidden" name="id" value="{{ $post->id }}">
    <div class="form-group">
      <label class="sr-only" for="email">Title</label>
      <input type="text" name="title" value="{{ $post->title }}" class="form-control" placeholder="Title">
    </div>

    <div class="form-group">
      <label class="sr-only" for="email">Description</label>
      <textarea name="description" class="form-control" placeholder="Description">{{ $post->description }}</textarea>
    </div>
    <div class="form-group">
      <label class="sr-only" for="email">Select Image</label>
      <input type="file" name="image" value="" class="form-control">
      <img src="{{ asset('uploads') }}/{{ $post->featured_image }}" style="  height: 100px; width: 150px;"/>
    </div>

    <button type="submit" class="btn btn-default">Save</button>

  </form>


  @include('layouts/footer')

@endsection