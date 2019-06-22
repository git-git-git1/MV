<?php
namespace app\index\controller;
use \think\Controller;

class Common extends Controller
{
    public function nav(){  //导航
        $nav=db('Types')->select();
        $type_id=request()->get('type_id') ? request()->get('type_id'):'';
        $this->assign('nav',$nav);
        $this->assign('type_id',$type_id);

        if(cookie('name')!=''){
            $tt=db('users')->where('username',cookie('name'))->find();
            $this->assign('tt',$tt);
        }

    }

    public function search(){  //搜索
        $this->nav();
        $search=request()->post('search');
            $where['title'] = ['like', "%{$search}%"];
            $where['singer'] = ['like', "%{$search}%"];
            $like['title'] = db('Mvs')->where('title', 'like', "%{$search}%")->select();
            $like['singer'] = db('Mvs')->where('singer', 'like', "%{$search}%")->select();

            //var_dump($like);
            if (!empty($like['title'])) {
                $rul_search = $like['title'];

            } else {
                $rul_search = $like['singer'];
            }
            $this->assign('rul_search',$rul_search);
        return view('search');
    }

}


?>