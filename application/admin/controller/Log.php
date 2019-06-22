<?php
namespace app\admin\controller;
use think\Controller;

class Log extends Controller{
    public function login(){
       return view('login');
    }

    public function loginlis(){
        $loginuser=request()->post();
        $user=db('users')->where('username',$loginuser['username'])->find();
       if($user && $user['status']!=0){
           if(md5($loginuser['password'])==$user['password']){
               cookie('username',$user['username']);
               $this->success('登录成功','/admin');
           }else{
               $this->error('密码错误！！');
           }
       }else{
           $this->error('用户名错误！！');
       }
    }

    public function logout(){
        cookie('username', null);
       if(cookie('username')==NULL){
           $this->success('退出成功！','/ad_login');
       }else{
           $this->error('退出失败！','/ad_logout');
       }

    }


}



?>