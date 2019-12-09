<?php

namespace App\Http\Middleware;

use Closure;
use App\Product;
use Illuminate\Http\Request;
use RakutenRws_Client; 
use App\Http\Requests\ProductRequest;
use Auth;


class RakutenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $client = new RakutenRws_Client();
        // アプリID (デベロッパーID) をセットします
        $client->setApplicationId('1067959486620993146');
        
        // 楽天市場商品検索API では operation として 'IchibaItemSearch' を指定してください。
        $response = $client->execute('IchibaItemSearch', array(
            'keyword' => $request->keyword
        ));
        
        // レスポンスが正常かどうかを isOk() で確認することができます
        if ($response->isOk()){

            $login_user = Auth::user();
            return view('search_page.products')->with(['response'=>$response, 'login_user'=>$login_user]);
            
        } else {
            // getMessage() でレスポンスメッセージを取得することができます
            echo 'Error:'.$response->getMessage();
        }

        return $response;
    }
}
