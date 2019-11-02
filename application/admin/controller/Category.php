<?php

namespace app\admin\controller;

use think\Controller;
use think\Exception;
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
        try {
            $model = model('Category');
            $request = $model->select();
//       print_r($request);
            if ($request) {
                return json([
                    'code' => config('code.success'),
                    'msg' => '分类查询成功',
                    'data' => $request,
                ]);
            } else {
                return json([
                    'code' => config('code.fail'),
                    'msg' => '分类查询失败',
                ]);
            }
        } catch (Exception $exception) {
            return json([
                'code' => config('code.fail'),
                'msg' => '服务器连接失败',
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
    {//
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
//        权限 身份 请求方式
//        验证参数
//        cname thumb sort
        //
        $data = $this->request->post();
        $validate = validate('Category');
        if (!$validate->scene('insert')->check($data)) {
            return json([
                'code' => config('code.fail'),
                'msg' => $validate->getError(),
            ]);
        }
        $model = model('Category');
        $request = $model->insert($data);
        if ($request > 0) {
            return json([
                'code' => config('code.success'),
                'msg' => '分类添加成功',
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '分类添加失败',
            ]);
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read($id)
    {
        $model = model('Category');
        $request = $model->finds($id);
        if ($request) {
            return json([
                'code' => config('code.success'),
                'msg' => '分类添加成功',
                'data'=>$request,
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '分类添加失败',
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
        $data = $this->request->put();
        $model = model('Category');
        $request = $model->updates($data,$id);
        if ($request) {
            return json([
                'code' => config('code.success'),
                'msg' => '分类修改成功',
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '分类修改失败',
            ]);
        }
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
        try {
            $model = model('Category');
            $request = $model->del($id);
            if ($request > 0) {
                return json([
                    'code' => config('code.success'),
                    'msg' => '数据删除成功',
                ]);
            } else {
                return json([
                    'code' => config('code.fail'),
                    'msg' => '数据删除失败',
                ]);
            }
        } catch (Exception $exception) {
            return json([
                'code' => config('code.fail'),
                'msg' => '服务器连接失败',
            ]);
        }//
    }
}
