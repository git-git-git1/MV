<?php
namespace app\admin\controller;
use think\Controller;

class User extends Controller
{
    public function index(){  //用户列表
        if(cookie('username')!=NULL) {
            $users = db('Users')->where('status=1')->paginate(20);
            $this->assign('users', $users);
            return view('index');
        }else{
            $this->error('请先登录！！！','/ad_login');
        }
    }

    public function add(){
        if(cookie('username')!=NULL) {
        return view('add');
        }else{
            $this->error('请先登录！！！','/ad_login');
        }
    }

    public  function addlis(){  //添加页面的信息发送到此方法中
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
            //插入数据库
            $insert = db('Users')->insert($data);
            if ($insert) {
                $this->success('添加成功！！', '/admin');
            }else{
                $this->error('添加失败！！', '/admin');
            }
        }else{
            $this->error('用户名，密码不得为空');
        }

    }

    public function edit(){   //用户修改
        if(cookie('username')!=NULL) {
        $id=request()->get('id');
        $user=db('Users')->where('id',$id)->find();
        $this->assign('user',$user);
        return view('edit');
        }else{
            $this->error('请先登录！！！','/ad_login');
        }
    }

    public function editlis(){  //修改数据发送到此方法
        //$id=request()->get('id');
        $data=request()->post();
        if($data['username']!='' && $data['password']!='') {
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
            //修改
            if (db('Users')->update($data)) {
                $this->success('修改成功', '/admin');
            } else {
                $this->error('修改失败', '/admin');
            }
        }else{
            $this->error('用户名，密码不得为空');
        }
    }

    public function delete(){   //用户删除
        $id=request()->get('id');
        if(db('Users')->where('id',$id)->update(['status'=>0])){
            $this->success('删除成功','admin');
        }else{
            $this->error('删除失败','admin');
        }
    }


}


?>