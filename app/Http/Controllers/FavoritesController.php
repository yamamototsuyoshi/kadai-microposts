<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store($id)
    {   
        //認証済みユーザ（閲覧者）が、idのマイクロポストにお気に入りを付ける
        \Auth::user()->favorite($id);
        //前のURLへリダイレクトさせる
        return back();
    }
    
    /**
     * マイクロポストをアンフォローするアクション
     */
    public function destroy($id)
    {   
        //認証済みユーザ（閲覧者）が、idのマイクロポストをお気に入りからはずす
        \Auth::user()->unfavorite($id);
        //前のURLへリダイレクトさせる
        return back();
    }
}
