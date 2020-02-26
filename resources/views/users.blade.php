
@extends('layouts.app')

@section('content')

@include('layouts/header')
  <p style="color:green;">
  {{ \Session::get('success') }}
</p>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<h3>User List</h3>
<table>
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
  </tr>
  @foreach($users as $user)
  <tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td> @if($user->user_role==2) Editor @else Reader @endif</td>
  </tr>
  @endforeach
  
</table>

@include('layouts/footer')

@endsection