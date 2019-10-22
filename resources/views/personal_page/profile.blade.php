<!doctype html>
<html lang="ja">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

  <title>Indi/トップページ</title>
</head>
<body>

  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
      </ul>
  </div>
  @endif

  <form method="POST" action="/profile" enctype="multipart/form-data" >
      {{ csrf_field() }}
      <input type="hidden" name="user_id" value="{{$user_id}}">
      <input type="file" name="image">
      <br>
      <textarea name="self_introduction" id="self-introduction" cols="30" rows="10"></textarea>
      <input type="submit">
  </form>


</body>
</html>