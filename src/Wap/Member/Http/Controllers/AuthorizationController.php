<?php

namespace Dresong\LaravelShop\Wap\Member\Http\Controllers;

use Illuminate\Http\Request;
use Dresong\LaravelShop\Wap\Member\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    public function wechatStore(Request $request)
    {
        $wechatUserInfo = session("wechat.oauth_user.default");
        $user = User::where("weixin_openid", $wechatUserInfo.id)->first();
        if (!$user) {
            User::create([
                "nickname" => $wechatUserInfo->nickname,
                "weixin_openid" => $wechatUserInfo.id,
                "image_head" => $wechatUserInfo->avatar,
            ]);
        }

        Auth::login($user);
        dd(Auth::check());

        return "in dresong\laravelshop wechatstore";
        //dd($wechatUserInfo);
    }
}
