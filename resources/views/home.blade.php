@extends('layouts.app')

@section('content')

@include('layouts/header')
    
    <div class="col-sm-9">
      <!-- <div class="well">
        <h4>Dashboard</h4>
        <p>Some text..</p>
      </div> -->
      <div class="row">
        <div class="col-sm-6">
          <div class="well">
            <h4>Users</h4>
            <p>{{$user_count}}</p> 
          </div>
        </div>
        <div class="col-sm-6">
          <div class="well">
            <h4>Posts</h4>
            <p>{{$post_count}}</p> 
          </div>
        </div>
     <!--    <div class="col-sm-3">
          <div class="well">
            <h4>Sessions</h4>
            <p>10 Million</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Bounce</h4>
            <p>30%</p> 
          </div>
        </div> -->
      </div>
    <!--   <div class="row">
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
            <p>Text</p> 
            <p>Text</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
            <p>Text</p> 
            <p>Text</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
            <p>Text</p> 
            <p>Text</p> 
          </div>
        </div>
      </div> -->
    <!--   <div class="row">
        <div class="col-sm-8">
          <div class="well">
            <p>Text</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
          </div>
        </div>
      </div> -->
    </div>
  @include('layouts/footer')

@endsection




