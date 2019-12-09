@extends('layouts.app')
@section('content')
  <ul>
    @foreach($users as $user)
      <a href="{{ action('UserController@show', $user) }}"><li>{{$user->name}}</li></a>
    @endforeach
  </ul>
@endsection

