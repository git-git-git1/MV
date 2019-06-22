<?php
namespace app\index\controller;
use \think\Controller;

class Lis extends Controller
{
    //列表
    public function lis(){
        $daoh=new Common();
        $daoh->nav();

        //显示列表
        $type_id=request()->get('type_id');
        if($type_id==''){
            $type_id=1;
        }
        $lis=db('Mvs')
            ->field('id,image,title,singer')
            ->where('type_id='.$type_id.' AND status=1')
            ->paginate(40, false, [
                'query' => ['type_id' => $type_id]
            ]);
        $this->assign('lis',$lis);
        $this->assign('type_id',$type_id);
        return view('lis');
    }




}


?>