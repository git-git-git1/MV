<?php
namespace app\index\controller;
use \think\Controller;

class Index extends Controller
{
    public function index()
    {
       $daoh=new Common();
        $daoh->nav();

        $db=db('Mvs');
        //轮播图  显示最新图片3个
        $v_sort=$db->field('id,title,singer,image,views,type_id')->where('status=1')->order('id desc')->select();

        //各类mv显示
        $type=db('Types')->select();
        $this->assign('type',$type);
        $this->assign('v_sort',$v_sort);
        return view('index');
    }




}
