<?php

namespace app\admin\model;

use think\Model;
use app\admin\model\Pcate;

class Download extends Model
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

       
    	return ['/uploads/'.$value];


    }

    public function getPidAttr($pid)
    {
    	# code...
    	$res=Dcate::find($pid);

    	return $res;
    }
}
