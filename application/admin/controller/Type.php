<?php
namespace app\admin\controller;
use think\Controller;
class Type extends Controller{   //视频列表
    public function index(){
        if(cookie('username')!=NULL) {
        $type=db('Types')->paginate(20);
        $this->assign('type',$type);
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

    public function addlis(){
        $data=request()->post();
        if($data['name']!='') {
            //插入数据库
            $insert = db('types')->insert($data);
            if ($insert) {
                $this->success('添加成功！！', '/type');
            }else{
                $this->error('添加失败！！', '/type');
            }
        }else{
            $this->error('类型名称不得为空');
        }

    }

    public function edit(){
        if(cookie('username')!=NULL) {
        $id=request()->get('id');
        $type=db('types')->where('id',$id)->find();
        $this->assign('type',$type);
        return view('edit');
        }else{
            $this->error('请先登录！！！','/ad_login');
        }
    }

    public function editlis(){
        $data=request()->post();
        if($data['name']!='') {
            //修改
            if (db('types')->update($data)) {
                $this->success('修改成功', '/type');
            } else {
                $this->error('修改失败', '/type');
            }
        }else{
            $this->error('类型名称不得为空');
        }
    }

    public function delete(){
        $id=request()->get('id');
        //exit(db('Mvs')->where('id',$id)->delete());
        if(db('types')->where('id',$id)->delete()){
            $this->success('删除成功','/type');
        }else{
            $this->error('删除失败','/type');
        }
    }

}




?>