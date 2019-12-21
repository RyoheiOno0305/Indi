<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use RakutenRws_Client; 
use App\Http\Requests\ProductRequest;
use Auth;
use Log;

class FavoriteController extends Controller
{
    //
    public function favorite(ProductRequest $request, $keyword){
        // プロダクト保存分岐
        $checkdata = Product::where('itemCode', $request->itemCode)->exists();
        if ($checkdata) {
            // お気に入り機能
            $product = Product::where('itemCode', $request->itemCode)->first();
            $login_user = Auth::user();
            $product_id = $product->id;
            // お気に入りしているか
            $is_liking = $login_user->isLiking($product_id);
            if (!$is_liking) {
                // お気に入りしていなければお気に入りする
                $login_user->like($product_id);
                return redirect()->route('toResults', ['keyword'=>$keyword])->with('success', '成功しました');
            } 
        } else {
            $product = new Product();
            $product->itemUrl = $request->itemUrl;
            $product->itemName = $request->itemName;
            $product->itemPrice = $request->itemPrice;
            $product->itemCode = $request->itemCode;
            $product->save();
            // お気に入り機能
            // $itemCode = $request->itemCode;
            $product = Product::where('itemCode', $request->itemCode)->first();
            // dd($product);
            $login_user = Auth::user();
            $product_id = $product->id;
            // dd($product_id);
            // お気に入りしているか
            $is_liking = $login_user->isLiking($product_id);
            if (!$is_liking) {
                // お気に入りしていなければお気に入りする
                $login_user->like($product_id);
                return redirect()->route('toResults', ['keyword'=>$keyword])->with('success', '成功しました');
            } 
        }
    }

    public function unfavorite(ProductRequest $request, $keyword){
        $product = Product::where('itemCode', $request->toGetId)->first();
        $login_user = Auth::user();
        $product_id = $product->id;
        // お気に入りしているか
        $is_liking = $login_user->isLiking($product_id);
        if ($is_liking) {
            // お気に入りしているプロダクトを解除する
            $login_user->unlike($product_id);
            return redirect()->route('toResults', ['keyword'=>$keyword])->with('success', '成功しました');
        }
    }
}
