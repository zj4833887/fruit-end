<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/10/30
 * Time: 19:11
 */

namespace app\admin\validate;


class Goods
{
    protected $rule = [
        'gname' => 'require|min:2|max:8',
        'gthumb' => 'require',
        'gmprice' => 'require|number|min:1|max:8',
        'sele' => 'require|number|min:1|max:8',
        'gstock' => 'require|number|min:1|max:8',
        'gbanner' => 'require',
        'gdetail' => 'require',
    ];
    protected $message = [
        'gthumb' => 'gthumb必填',
        'gname.require' => 'gname必填',
        'gname.min' => 'cname最少2个字段',
        'gmprice.min' => 'cname最少1个字段',
        'gmprice.require' => 'gmprice必填',
        'sele.require' => 'sele必填',
        'gstock.require' => 'gstock必填',
        'gbanner.require' => 'gbanner必填',
        'gdetail.require' => 'gdetail必填',
        'sele.min' => 'sele最少1个字段',
        'gstock.min' => 'gstock最少1个字段',
    ];
    protected $scene = [
        'insert' => ['gthumb', 'gname', 'gmprice','sele', 'gstock', 'gbanner','gdetail']
    ];
}