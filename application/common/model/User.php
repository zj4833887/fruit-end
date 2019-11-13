<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/11/7
 * Time: 14:28
 */

namespace app\common\model;


use think\Model;

class User extends Model
{
    protected $table='users';
    protected $autoWriteTimestamp=true;
    public  function  insert($data){
        return $this->allowField(true)->save($data);
    }
    public function queryuser($where){
         return $this->where($where)->select();
    }
    public function queryone($id){
        return $this->find($id);
    }

}