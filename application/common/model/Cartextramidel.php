<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/11/11
 * Time: 17:08
 */

namespace app\common\model;


use think\Model;

class Cartextramidel extends Model
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
        return $this->where($where)->setInc('num');
    }

    public function querygoods($uid){
        return $this->field('gid,num,status')->where('uid',$uid)->select();
    }
}