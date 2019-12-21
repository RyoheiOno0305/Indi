@extends('layouts.app')

@section('content')
  @if (session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif
  <body>
    <div class="count">
      {{$response['count']}}件見つかりました。
    </div>

    <div class="offset-md-1 col-md-10">
      @foreach($response as $product)
        <div class="product-box">
          <div class="swiper-container">
            <div class="swiper-wrapper">
              @foreach($product["mediumImageUrls"] as $image)
                <div class="swiper-slide"><img src="{{$image['imageUrl']}}" alt=""></div>
              @endforeach
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>  
          <p><a href="{{$product['itemUrl']}}">{{$product['itemName']}}</a></p>
          <p>値段：{{$product['itemPrice']}}円</p>
          <p>レビュー：{{$product['reviewAverage']}}</p>
          @if ($login_user->itemCodeLiking($product['itemCode']))
              <form action="{{ route('unfavorite', ['keyword' => $keyword])}}" method="POST">
                  @csrf
                  {{ method_field('DELETE') }}
                  <input type="hidden" name='toGetId' value={{$product['itemCode']}}>
                  <button type="submit" class="btn btn-danger">お気に入り解除</button>
              </form>
          @else
              <form action="{{ route('favorite', ['keyword' => $keyword])}}" method="POST">
                  @csrf
                  <input type="hidden" name='itemUrl' value={{$product['itemUrl']}}>
                  <input type="hidden" name='itemPrice' value={{$product['itemPrice']}}>
                  <input type="hidden" name='itemCode' value={{$product['itemCode']}}>
                  <input type="hidden" name='itemName' value={{$product['itemName']}}> 
                  <button type="submit" class="btn btn-primary">お気に入り</button>
              </form>
          @endif
        </div>
      @endforeach
    </div>


<script src="{{ asset('js/swiper.js') }}"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
            },
            loop: true,
        });
    </script>

@endsection