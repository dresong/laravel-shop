<?php
use Illuminate\Support\Facades\Auth;

Route::get("wechatStore", "AuthorizationController@wechatStore")->middleware("wechat.oauth");

Route::get("config", function(){
    dd(config());
    //dd(Auth::guard('member'));
});
