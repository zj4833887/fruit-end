<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/11/11
 * Time: 14:53
 */

namespace app\index\controller;


use think\Controller;
use think\Db;

class Cart extends Controller
{
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        checkToken();
    }

    public function save()
    {
        $uid = $this->request->id;
        $data = $this->request->post();
        $gid = $data['gid'];
        $sale = $data['price'];
        $model = model('Cartmodel');
        $cart = $model->queryone($uid);
        $cid = $cart['cid'];
        if ($cart) {
            $IncRes='';
            $insertRes='';
            $extramodel = model('Cartextramidel');
            $goodsInfo = $extramodel->queryone(['uid' => $uid, 'gid' => $gid]);
            if ($goodsInfo) {
                $IncRes = $extramodel->goodsnumInc(['uid' => $uid, 'gid' => $gid]);
            } else {
                $insertRes = $extramodel->insertgoods(['cid' => $cid, 'gid' => $gid, 'num' => 1, 'status' => 1, 'uid' => $uid]);
            }
            $numberInc = $model->cartInc($uid, 'total');
            $priceInc = $model->cartInc($uid, 'price', $sale);
            if (($IncRes && $numberInc && $priceInc) || ($insertRes && $numberInc && $priceInc)) {
                Db::commit();
                return json([
                    'code'=>config('code.success'),
                    'msg'=>'购物车添加成功',
                    'data'=>[
                        'cid'=>$cid,'uid'=>$uid
                    ]
                ]);
            } else {
                Db::rollback();
            }
        } else {
            Db::startTrans();
            $arr = ['id' => $uid, 'total' => 1, 'price' => $data['price']];
            $rows = $model->insertCart($arr);
            $cid = $model->getLastInsId();
            $goods = ['cid' => $cid, 'gid' => $data['gid'],
                'num' => 1, 'status' => 1, 'uid' => $uid
            ];
            $result = Db::table('cart_extra')->insert($goods);
            if ($rows && $result) {
                Db::commit();
                return json([
                    'code' => config('code.success'),
                    'msg' => "添加成功",
                    'data'=>[
                        'cid'=>$cid,'uid'=>$uid
                    ]
                ]);
            } else {
                Db::rollback();
            }
        }
    }
    public function read($id){
        $uid=$this->request->id;
        $cartModel=model('Cartmodel');
        $cart=$cartModel->queryone($uid);
//        $Cartextramidel=model('Cartextramidel');
//        $goods=$Cartextramidel->queryGoods($uid);

        $goods=Db::table('cart_extra')->alias('c')
            ->field('c.gid,c.num,c.status,goods.gname,goods.sele,goods.thumb')
            ->join('goods','c.gid=goods.id')
            ->select();
        if ($cart){
            $cart['goods']=$goods;
            return json([
                'code'=>config('code.success'),
                'msg'=>'购物车获取成功',
                'data'=>$cart
            ]);
        }else{
            return json([
                'code'=>config('code.success'),
                'msg'=>'购物车为空'
            ]);
        }

    }

}