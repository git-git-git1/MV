<?php
namespace app\index\controller;
use think\Controller;

class Rlog extends Controller{
    public function reg(){   //注册页
        return view('reg');
    }

    public function reglis(){
        $data=request()->post();
        if($data['username']!='' && $data['password']!='' && $data['repassword']!='') {
            if ($data['password'] != $data['repassword']) {
                $this->error('密码和确认密码不一致！！');
            }
            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('profile');

            // 移动到框架应用根目录/public/uploads/ 目录下
            if ($file) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    $dbpath = '/uploads/' . $info->getSaveName();
                    $dbpath = str_replace('\\', '/', $dbpath);
                    $data['profile'] = $dbpath;
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }
            $data['password'] = md5($data['password']);
            $data['addtime'] = date('Y-m-d H:i:s');
            $data['status'] = 1;
            unset($data['repassword']);
            //插入
            $insert = db('Users')->insert($data);
            if ($insert) {
                $this->success('注册成功！！', '/log');
            }else{
                $this->error('注册失败！！', '/reg');
            }
        }else{
            $this->error('用户名，密码不得为空');
        }

    }

    public function log(){
        return view('log');
    }

    public function loglis(){
        $loginuser=request()->post();
        $user=db('users')->where('username',$loginuser['username'])->find();
        if($user && $user['status']!=0){
            if(md5($loginuser['password'])==$user['password']){
                cookie('name',$user['username']);
                $this->success('登录成功','/index');
            }else{
                $this->error('密码错误！！');
            }
        }else{
            $this->error('用户名错误！！');
        }
    }

    public function logout(){
        cookie('name', null);
        if(cookie('name')==NULL){
            $this->success('退出成功！','/index');
        }else{
            $this->error('退出失败！','/index');
        }
    }




}



?>