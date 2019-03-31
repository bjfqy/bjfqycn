<?php

namespace app\admin\model;

use think\Model;
use think\Collection;

class Dcate extends Model
{
    //创建一个静态方法 getCate 来获取分类

    public static function getCate($pid=0,&$result=[],$blank=0)
    {
    	$res = self::all(['pid'=>$pid]);

    	$blank +=2;

    	foreach ($res as $key => $value) {
    		# code...

    		$cate_name = '|--'.$value->catename;
    		$value->catename = str_repeat('--', $blank).$cate_name;

    		$result[] =$value;

    		self::getCate($value->id,$result,$blank);

    	}

    	return Collection::make($result)->toArray();
    }
    
}
