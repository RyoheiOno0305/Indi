@extends('layouts.app')

@section('content')
  <div class='offset-md-4'>
    <form action="{{url('/search')}}" method="POST">
        @csrf
        <input type="text" name="keyword">
        <input type="submit" value="送信">
    </form>
  </div>
@endsection

