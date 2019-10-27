<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use RakutenRws_Client; 

class ProductController extends Controller
{

    public function search(){
        return view('search_page.search');
    }

    public function results(Request $request){

        // $client = new Client();
        // $response = $client->request('GET', 
        // 'https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706?',
        // array(
            
        //     "query"=>[
        //             'applicationId='=>'1067959486620993146',
        //             'formatVersion'=>'2',
        //             'keyword'=>$request->keyword,
        //             'imageFlag'=>1
        //     ],
        //     "http_errors" => false,
        // )
        // );

        
        // $json = $response->getBody()->getContents();
        // $results = json_decode($json, true);
        // // return view('search_page.product')->with('results',$results);
        // var_dump($results);







        
        
        $client = new RakutenRws_Client();
        // アプリID (デベロッパーID) をセットします
        $client->setApplicationId('1067959486620993146');
        
        // 楽天市場商品検索API では operation として 'IchibaItemSearch' を指定してください。

        $response = $client->execute('IchibaItemSearch', array(
            'keyword' => $request->keyword
        ));
        
        // レスポンスが正常かどうかを isOk() で確認することができます
        if ($response->isOk()){

            return view('search_page.product')->with('response',$response);
            
        } else {
            // getMessage() でレスポンスメッセージを取得することができます
            echo 'Error:'.$response->getMessage();
        }

    }



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
    public function store(Request $request)
    {
        //
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
