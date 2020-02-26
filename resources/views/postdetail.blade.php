@extends('layouts.app')

@section('content')

@include('layouts/header')

<h1>{{ $post->title }}</h1>

<details>
  <summary>Slug :- {{ $post->slug}}</summary>
  <p>{{ $post->description }}</p>
</details>
  <img src="{{ asset('uploads') }}/{{$post->featured_image}}" style="width: 191px;" />

@include('layouts/footer')

@endsection