

@extends('layouts.app')

@section('content')


  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
  


  <!-- オフセット用のdiv -->
  <div class="offset-box offset-md-1 col-md-10">

    <!-- プロフィール -->
    <div class="profile-box" class="offset-md-1 col-md-10">
      <span class="col-md-3">
        <img class="profile-image" src="/storage/profile_images/{{Auth::id()}}.jpg"  width="200px" >
      </span>
        @if(empty($profile->self_introduction))
          <span class="introduction offset-md-1 col-md-8">プロフィールを登録しましょう</span>
        @else
          <span class="introduction  col-md-8">{{$profile->self_introduction}}<span>
        @endif
    </div>
    

    
    <!-- フォロー・アンフォロー機能 -->
    @if($login_user->id !== $user_id)
        <div class="d-flex justify-content-end flex-grow-1">
            @if ($login_user->isFollowing($user_id))
                <form action="{{ route('unfollow', ['id' => $user_id]) }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger">フォロー解除</button>
                </form>
            @else
                <form action="{{ route('follow', ['id' => $user_id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">フォローする</button>
                </form>
            @endif
        </div>
    @else
        <div></div>
    @endif
    
    @if($user_id !== $login_user->id)
      <a href="/chat"><button type="button" class="btn btn-primary">Chat</button></a>
    @endif
    
    <!-- タブリスト -->
    <div class="tabs-list">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="#product-list" class="nav-link active" data-toggle="tab">プロダクトリスト</a>
        </li>
        <li class="nav-item">
          <a href="#favorite" class="nav-link" data-toggle="tab">お気に入り</a>
        </li>
        <li class="nav-item">
          <a href="#follow" class="nav-link" data-toggle="tab">フォロー</a>
        </li>
        <li class="nav-item">
          <a href="#follower" class="nav-link" data-toggle="tab">フォロワー</a>
        </li>
      </ul>
    </div>


    <!-- タブコンテント -->
    <div class="tab-content">
      <div id="product-list" class="tab-pane active">
        <div>プロダクトリスト</div>
      </div>
      <div id="favorite" class="tab-pane">
        <div>お気に入り</div>
      </div>
      <div id="follow" class="tab-pane">
        <ul>
        @foreach($follows as $follow)
          <li>{{$follow->name}}</li>
        @endforeach
        </ul>
      </div>
      <div id="follower" class="tab-pane">
        <ul>
        @foreach($followers as $follower)
          <li>{{$follower->name}}</li>
        @endforeach
        </ul>
      </div>
    </div>
  </div>
@endsection
