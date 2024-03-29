<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/10/30
 * Time: 19:08
 */

namespace app\common\model;


use think\Model;

class Goods extends Model
{
    //    protected $table='admin' 修改表名
//protected $autoWriteTimestamp; 自动写时间戳，只针对一个模型，必须是create_time,update_time,这两个名字
    public function insert($data){
        $data['create_time']=time();
        $data['update_time']=time();
        return $this->allowField(true)->save($data);
    }
    public function select($data = null)
    {
        return parent::select($data); // TODO: Change the autogenerated stub
    }
    public function del($id)
    {
        return $this->where('id',$id)->delete();
    }
    public function finds($id){
        return $this->field('gname,thumb,gbanner,sele,gmprice,sele,gstock,gdetail,cid,describe,brand,norms,status')->where('id',$id)->find();
    }
    public function updates($data,$id){
        return $this->where('id',$id)->update($data);
    }

}