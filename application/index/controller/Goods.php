<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Goods extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data=$this->request->get();
        //验证cid

        if (isset($data['page'])&&!empty($data['page'])){
            $page=$data['page'];
        }else{
            $page=1;
        }
        if (isset($data['limit'])&&!empty($data['limit'])){
            $limit=$data['limit'];
        }else{
            $limit=2;
        }
        $id=$data['id'];
        $request= Db::table('goods')
            ->field('id,thumb,gname,gmprice,sele')
            ->order('id','asc')->where('cid',$id)
            ->paginate($limit,false,[
                'page'=>$page,
            ]);
        $count=$request->total();
        $goods=$request->items();

//       print_r($request);
        if ($count>0 && count($goods)>0) {
            return json([
                'code' => config('code.success'),
                'msg' => '分类商品查询成功',
                'data' => $goods,
                'count'=>$count,
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '分类商品查询失败',
            ]);
        }
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $request= Db::table('goods')->select();
        if ($request) {
            return json([
                'code' => config('code.success'),
                'msg' => '商品查询成功',
                'data' => $request,
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '商品查询失败',
            ]);
        }
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $request= Db::table('goods')->where('id',$id)->find();
        if ($request) {
            return json([
                'code' => config('code.success'),
                'msg' => '商品查询成功',
                'data' => $request,
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '商品查询失败',
            ]);
        }
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
