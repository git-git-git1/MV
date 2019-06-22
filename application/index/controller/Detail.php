<?php
namespace app\index\controller;
use \think\Controller;
class Detail extends Controller
{
    public function detail(){
        $daoh=new Common();
        $daoh->nav();

        $db=db('Mvs');

        //显示音乐
        $id=request()->get('music_id');
        $url=$db->find($id);

        //显示热播 显示4个
        $views=$db->field('id,title,singer,image,views')->where('status=1')->select();
        foreach($views as $k => $view){
            if(strpos($view['views'],'万')!=false){
                $views[$k]['views'] = (int)($view['views'])*10000;
            }else{
                $views[$k]['views'] = $view['views']*1;
            }

        }
        $v_sort = arr_sort($views,'views','desc'); //二维数组排序降序

        //查找歌手的其他作品
        $singer=array();
        for($i=4;$i<(count($v_sort)-4);$i++){
            for($j=0;$j<4;$j++){
                if($v_sort[$i]['singer']=$v_sort[$j]['singer']){
                  $singer[]=$v_sort[$i];
                }
            }
        }
        //var_dump($singer);

        $this->assign('singer',$singer);
        $this->assign('v_sort',$v_sort);
        $this->assign('url',$url);
        return view('detail');
    }



}



?>