<?php

namespace app\admin\controller;

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
        try {
            $data=$this->request->get();
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
            $sarr=[];
            if (isset($data['cid'])&&!empty($data['cid'])){
                $sarr['cid']=['like',$data['cid']];
            }
            if (isset($data['gname'])&&!empty($data['gname'])){
                $sarr['gname']=['like','%'.$data['gname'].'%'];
            }
            if(isset($data['min_peice'])&&!empty($data['min_peice'])&&isset($data['max_peice'])&&!empty($data['max_peice'])){
                $sarr['sele'] = [
                    'between',[$data['min_peice'],$data['max_peice']]
                ];
            };
            $request= Db::table('goods')->join('category','goods.cid=category.id')
                ->field('category.cname,goods.*')
                ->where($sarr)
                ->paginate($limit,false,[
                    'page'=>$page,
                ]);
            $count=$request->total();
            $goods=$request->items();

//       print_r($request);
            if ($count>0 && count($goods)) {
                return json([
                    'code' => config('code.success'),
                    'msg' => '分类查询成功',
                    'data' => $goods,
                    'count'=>$count,
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
        $data = $this->request->post();
//        $validate = validate('Goods');
//        if (!$validate->scene('insert')->check($data)) {
//            return json([
//                'code' => config('code.fail'),
//                'msg' => $validate->getError(),
//            ]);
//        }
        $model = model('Goods');
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
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $model = model('Goods');
        $request = $model->finds($id);
        if ($request) {
            return json([
                'code' => config('code.success'),
                'msg' => '商品查询成功',
                'data'=>$request,
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '商品查询失败',
            ]);
        }
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        echo 'edit';
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
        $data = $this->request->put();
        $model = model('Goods');
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
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        try {
            $model = model('Goods');
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
