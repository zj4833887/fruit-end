<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Category extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $result=Db::table('goods')->select();
        if ($result) {
            return json([
                'code' => config('code.success'),
                'msg' => '数据获取成功',
                'data'=>$result
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '数据获取失败',
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
        $count=Db::table('category')->where('id',$id)->find();
        if ($count) {
            return json([
                'code' => config('code.success'),
                'msg' => '标题获取成功',
                'count'=>$count
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '标题获取失败',
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
