<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/11/13
 * Time: 19:20
 */

namespace app\common\model;


use think\Model;

class Reducemidel extends Model
{
    public $table='cart_extra';
    public function queryone($data){
        return $this->where($data)->find();
    }
    public function insertgoods($data){
        return  $this->allowField(true)->save($data);
    }
    //谁的购物车 哪件商品 num
    public function  goodsnumInc($where){
        return $this->where($where)->decInc('num');
    }

    public function querygoods($uid){
        return $this->field('gid,num,status')->where('uid',$uid)->delete();
    }

}