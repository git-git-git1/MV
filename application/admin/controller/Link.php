<?php
namespace app\admin\controller;
use think\Controller;
class Link extends Controller{   //视频列表
    public function index(){
        if(cookie('username')!=NULL) {
        $link=db('links')->where('status=1')->paginate(20);
        $this->assign('link',$link);
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
        if($data['title']!='') {
            //插入数据库
            $insert = db('links')->insert($data);
            if ($insert) {
                $this->success('添加成功！！', '/link');
            }else{
                $this->error('添加失败！！', '/link');
            }
        }else{
            $this->error('友情链接名称不得为空');
        }

    }

    public function edit(){
        if(cookie('username')!=NULL) {
        $id=request()->get('id');
        $link=db('links')->where('id',$id)->find();
        $this->assign('link',$link);
        return view('edit');
        }else{
            $this->error('请先登录！！！','/ad_login');
        }
    }

    public function editlis(){
        $data=request()->post();
        if($data['title']!='') {
            //修改
            if (db('links')->update($data)) {
                $this->success('修改成功', '/link');
            } else {
                $this->error('修改失败', '/link');
            }
        }else{
            $this->error('友情链接名称不得为空');
        }
    }

    public function delete(){
        $id=request()->get('id');
        if(db('links')->where('id',$id)->update(['status'=>0])){
            $this->success('删除成功','/link');
        }else{
            $this->error('删除失败','/link');
        }
    }

}




?>