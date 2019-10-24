<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Indi/トップページ</title>
  </head>
  <body>


  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
  

  <!--ナビバー-->
  <nav class='navbar navbar-light bg-light'>
      <a class="navbar-brand offset-md-1" href="#">Indi</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="ナビゲーションの切替">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav offset-md-1">
            <a class="nav-item nav-link active" href="#">ホーム <span class="sr-only">(現位置)</span></a>
            <a class="nav-item nav-link" href="#">リンク1</a>
            <a class="nav-item nav-link" href="#">リンク2</a>
          </div>
      </div>
  </nav>


  <!-- オフセット用のdiv -->
  <div class="offset-box offset-md-1 col-md-10">

    <!-- プロフィール -->
    <div class="profile-box" class="offset-md-1">
      <p>
        <img class="profile-image" src="storage/profile_images/{{$user_id}}.jpg" width="200px" >
      </p>
        @if(empty($profile->self_introduction))
          <p>プロフィールを登録しましょう</p>
        @else
          <p class="introduction">{{$profile->self_introduction}}</p>
        @endif
    </div>
    
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
        <div>フォロー</div>
      </div>
      <div id="follower" class="tab-pane">
        <div>フォロワー</div>
      </div>
    </div>
      
      <!-- <div class='product-list'>プロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリストプロダクトリスト</div> -->
    
  




  </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>