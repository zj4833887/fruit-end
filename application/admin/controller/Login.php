<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/10/29
 * Time: 10:23
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\Exception;
use think\JWT;

class Login extends Controller
{
    public function index(){
        try{
            $data=$this->request->post();
//        $result = input('post.');
            $salt=config('salt');
            $password=$data['password'];
//        $data['password']=md5(crypt($password,md5($salt)));
            $data['password']=md5($password);
            $result=Db::table('manage')->where($data)->find();
//            print_r($result);
            if ($result){
                $payload=['id'=>$result['id'],'names'=>$result['names']];
                $token=JWT::getToken($payload,config('jwtkey'));
                return json([
                    'code'=>config('code.success'),
                    'msg'=>'成功',
                    'data'=>[
                        'token'=>$token,
                        'names'=>$result['names']
                    ]
                ]);
            }else{
                return json([
                    'code'=>config('code.fail'),
                    'msg'=>'失败'
                ]);
            }
            return json($result);

        }catch (Exception $exception){
            return json([
                'code'=>config('fail'),
                'msg'=>'服务器错误'
            ]);
        }

    }

}