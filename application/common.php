<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//导航列表

function arr_sort($array,$key,$order='desc'){
    $arr_num=$arr=array();
    foreach($array as $k=>$v){
        $arr_num[$k]=$v[$key];
    }
    if($order='desc'){
        arsort($arr_num);
    }else{
        asort($arr_num);
    }
    foreach($arr_num as $k=>$v){
        $arr[]=$array[$k];
    }
    return $arr;

}