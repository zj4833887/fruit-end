<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 *
 */

use think\JWT;

function checkToken()
{
    $token = '';
    if (request()->get('token')) {
        $token = request()->get('token');
    } else if (request()->post('token')) {
        $token = request()->post('token');
    } else if (request()->header('token')) {
        $token = request()->header('token');
    }

    if (!$token) {
        json(['code' => 401, 'msg' => 'token不能为空'])->send();
        exit();
    }
    $res = JWT::verify($token, config('jwtkey'));
//   var_dump($res);
    if(!$res){
        json(['code' => 401, 'msg' => 'token验证失败'])->send();
        exit();
    }
    request()->id=$res['id'];
    request()->nickname=$res['nickname'];
//    $res = JWT::verify($token, config(''));

//    request()->id = $res['id'];
//    request()->nickname = $res['nickname'];
    function SexCodeToText($code)
    {
        switch ($code) {
            case 0;
                $res = '未填写';
                break;
            case 1;
                $res = '男';
                break;
            case 2;
                $res = '女';
                break;
            default:
                $res = "未填写";
                break;
        }


    }
}