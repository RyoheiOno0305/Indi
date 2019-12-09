@extends('layouts.app')

@section('content')

  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
      </ul>
  </div>
  @endif
  <div class='form-box offset-md-3'>
    <form method="POST" action="/user" enctype="multipart/form-data" >
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value={{ $user_id }}>
        <input type="file" name="image">
        <br>
        <br>
        <textarea name="self_introduction" id="self-introduction" cols="30" rows="10"></textarea>
        <input type="submit">
    </form>    
  </div>
@endsection

