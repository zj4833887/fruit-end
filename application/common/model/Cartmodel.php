<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/11/11
 * Time: 15:35
 */

namespace app\common\model;


use think\Model;

class Cartmodel extends Model
{
    protected $table='cart';
    public function queryone($uid){
        return $this->where('id',$uid)->find();
    }
    public function  insertCart($data){
        return $this->allowField(true)->save($data);
    }
    //谁 total price
    public function cartInc($uid,$filed,$value=1){
        return $this->where('id',$uid)->setInc($filed,$value);
    }
}