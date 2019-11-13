<?php

namespace app\index\controller;

use think\Controller;
use think\Exception;
use think\Request;

class User extends Controller
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
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
        $data = $this->request->post();
        $model = model('User');
        $request = $model->queryuser(['tel' => $data['tel']]);
        if (count($request) > 0) {
            return json([
                'code' => config('code.fail'),
                'msg' => '该手机号已经注册',
            ]);
        }
        $request = $model->queryuser(['nickname' => $data['nickname']]);
        if (count($request) > 0) {
            return json([
                'code' => config('code.fail'),
                'msg' => '该用户名已经注册',
            ]);
        }
//        $salt=config('salt');
        $data['password'] = crypt($data['password'], md5($data['password']));
        $request = $model->insert($data);
        if ($request) {
            return json([
                'code' => config('code.success'),
                'msg' => '注册成功',
                'data' => $request,

            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '注册失败',
            ]);
        }

        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read($id)
    {
        checkToken();
        $id=$this->request->id;
        $nickname=$this->request->nickname;
        $model=model('User');
        $request=$model->queryone($id);
        if ($request) {
            return json([
                'code' => config('code.success'),
                'msg' => '注册成功',
                'data' => $request,
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '注册失败',
            ]);
        }
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
