<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/10/29
 * Time: 16:51
 */

namespace app\admin\validate;


use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'cname' => 'require|min:2|max:4',
        'thumb' => 'require',
        'sort' => 'require|number'
    ];
    protected $message = [
        'thumb' => 'thumb必填',
        'cname.require' => 'cname必填',
        'cname.min' => 'cname最少4个字段'
    ];
    protected $scene = [
        'insert' => ['cname', 'thumb', 'sort']
    ];
}