<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/25
 * Time: 17:35
 */
namespace app\common\validate;
use think\Validate;

class Admin extends Validate {
    protected $rule =   [
        'username'      => 'require|max:25',
        'password'     => 'require',
    ];
    protected $message  =   [
        'username.require' => '名称必须',
        'username.max'     => '名称最多不能超过25个字符',
        'password.require' => '密码不能为空'

    ];

}