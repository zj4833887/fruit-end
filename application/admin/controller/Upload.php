<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Upload extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
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
        $file=$this->request->file('file');
        $info = $file->validate(['size'=>1024*1024,'ext'=>'webp,jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $savename=UPLOAD_PATH . $info->getSaveName();
            return json( [
                'code'=>config('code.success'),
                'msg'=>"图片上传成功",
                'src'=>$savename,
            ]);
            // 成功上传后 获取上传信息
        }else{
            // 上传失败获取错误信息
           return json([
               'code'=>config('code.fail'),
               'msg'=>$file->getError(),
           ]);
        }
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
