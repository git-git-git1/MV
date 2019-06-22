<?php
namespace app\admin\controller;
use think\Controller;
class Mv extends Controller{   //视频列表
    public function index(){
        if(cookie('username')!=NULL) {
        $mv=db('Mvs')->where('status=1')->order('id desc')->paginate(20);
        $type=db('Types')->select();
        $this->assign('type',$type);
        $this->assign('mv',$mv);
        return view('index');
        }else{
            $this->error('请先登录！！！','/ad_login');
        }
    }

    public function add(){
        if(cookie('username')!=NULL) {
        $type=db('types')->select();
        $this->assign('type',$type);
        return view('add');
        }else{
            $this->error('请先登录！！！','/ad_login');
        }
    }

    public function addlis(){

        $data=request()->post();

        if($data['title']!='') {
            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('image');

            // 移动到框架应用根目录/public/uploads/ 目录下
            if ($file) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    $dbpath = '/uploads/' . $info->getSaveName();
                    $dbpath = str_replace('\\', '/', $dbpath);
                    $data['image'] = $dbpath;
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }
            $data['status'] = 1;
            //插入数据库
//            var_dump($data);
//            die;
            $insert = db('Mvs')->insert($data);
            if ($insert) {
                $this->success('添加成功！！', '/mv');
            }else{
                $this->error('添加失败！！', '/mv');
            }
        }else{
            $this->error('歌名不得为空');
        }

    }

    public function edit(){
        if(cookie('username')!=NULL) {
        $id=request()->get('id');
        $mv=db('Mvs')->where('id',$id)->find();

        $type=db('types')->select();
        $this->assign('type',$type);

        $this->assign('mv',$mv);
        return view('edit');
        }else{
            $this->error('请先登录！！！','/ad_login');
        }
    }

    public function editlis(){
        $data=request()->post();
        if($data['title']!='') {
            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('image');
            // 移动到框架应用根目录/public/uploads/ 目录下
            if ($file) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    $dbpath = '/uploads/' . $info->getSaveName();
                    $dbpath = str_replace('\\', '/', $dbpath);
                    $data['image'] = $dbpath;
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }
            //修改
            if (db('mvs')->update($data)) {
                $this->success('修改成功', '/mv');
            } else {
                $this->error('修改失败', '/mv');
            }
        }else{
            $this->error('歌名不得为空');
        }
    }

    public function delete(){
        $id=request()->get('id');
        if(db('Mvs')->where('id',$id)->update(['status'=>0])){
            $this->success('删除成功','/mv');
        }else{
            $this->error('删除失败','/mv');
        }
    }

}




?>