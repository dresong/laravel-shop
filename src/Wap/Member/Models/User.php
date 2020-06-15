<?php

namespace Dresong\LaravelShop\Wap\Member\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = "sys_user";
    protected $fillable = array(
        "nickname",
        "weixin_openid",
        "image_head"
    );
}
