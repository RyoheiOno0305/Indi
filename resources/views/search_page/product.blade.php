<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- css  -->
    <link rel="stylesheet" type="text/css" href="css/styles.css">


    <!-- swiper -->
    <link rel="stylesheet" href="css/swiper.css">
    

    


    <title>Indi/トップページ</title>
  </head>
  <body>
    <p>
      {{$response['count']}}件見つかりました。
    </p>

    <div class="offset-md-1 col-md-10">
      @foreach($response as $item)

        <div class="product-box">
          <div class="swiper-container">
            <div class="swiper-wrapper">
              @foreach($item["mediumImageUrls"] as $image)
                <div class="swiper-slide"><img src="{{$image['imageUrl']}}" alt=""></div>
              @endforeach
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
          <p><a href="{{$item['itemUrl']}}">{{$item["itemName"]}}</a></p>
          <p>{{$item['itemPrice']}}円</p>
          <p>{{$item['reviewAverage']}}</p>
        </div>
      
        
        
        

      @endforeach
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script> 
    <script src="js/swiper.js"></script>
    <script>
      var swiper = new Swiper('.swiper-container', {
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        loop: true,
      });
    </script>
  </body>
</html>