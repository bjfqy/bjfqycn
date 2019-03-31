<?php

namespace app\admin\model;

use think\Model;

class Article extends Model
{
    //
        protected $autoWriteTimestamp = true;
    protected $type = [
        'create_time'  =>  'timestamp',
    ];    
    //protected $autoWriteTimestamp = 'datetime';
    
    public function getImageAttr($value)
    {
    	# code...
    	if (strpos($value, '|')) {
    		# code...

    		$img=explode('|', $value);

            foreach ($img as $key => $v) {
                # code...
                 $img[$key]='/uploads/'.$v;
            }

            return $img;

    	}

       //if
    	return ['/uploads/'.$value];

    }
    
}
