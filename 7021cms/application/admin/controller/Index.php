<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/10
 * Time: 13:12
 */
namespace app\admin\controller;

use think\Controller;
use app\common\model\Admin as AdminModel;
use app\common\validate\Admin as AdminValidate;

class Index extends Controller{
    public function index(){
        if(session('admin')){
            return $this->fetch();
        }else{
            return $this->fetch('login');
        }

    }
    public function check(){
        $model = new AdminModel();
        if($_POST){
            $validate = new AdminValidate();
            if(!$validate->check($_POST)){
                show(0,$validate->getError());
            }
    }
        $ret = $model->where(["username"=>$_POST['username']])->select();
        if(!$ret){
            return show(0,'该用户不存在');
        }

        if($ret[0]['password'] != getMd5Password($_POST['password'])){
            return show(0,'密码错误');
        }
        session('admin',$ret);
        return show(1,'登录成功');
    }

    //验证码demo
    public function vendor(){
       if(request()->isPost()){
           $data = input('post.');
           if(!captcha_check($data['vendor'])){
                //校验失败
               $this->error('验证码不正确');
           }else{
               echo 'success';
           }
       }
    }
    public function demo(){
//        echo '1';
        return $this->fetch('demo');
    }
}