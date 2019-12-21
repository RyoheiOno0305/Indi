<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use RakutenRws_Client; 
use App\Http\Requests\ProductRequest;
use Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search()
    {
        return view('search_page.search');
    }

    public function toResults(Request $request){
        $keyword = $request->keyword;
        return redirect()->route('toResults', ['keyword'=>$keyword]);
    }

    public function results($keyword)
    {

        $client = new RakutenRws_Client();
        // アプリID (デベロッパーID) をセットします
        $client->setApplicationId('1067959486620993146');
        
        // 楽天市場商品検索API では operation として 'IchibaItemSearch' を指定してください。
        $response = $client->execute('IchibaItemSearch', array(
            'keyword' => $keyword
        ));
        
        // レスポンスが正常かどうかを isOk() で確認することができます
        if ($response->isOk()){

            $login_user = Auth::user();
            return view('search_page.products')->with(['response'=>$response, 'login_user'=>$login_user, 'keyword'=>$keyword]);
            
        } else {
            // getMessage() でレスポンスメッセージを取得することができます
            echo 'Error:'.$response->getMessage();
        }
    }


    // ↓はとりあえず無視
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        
        return view('search_page.each_product');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
