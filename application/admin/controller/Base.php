<?php 

namespace app\admin\controller;

use think\Controller;


/**
 * 后台初始化控制器用于提供很多验证服务等于中间件
 */
class Base extends Controller
{
	//前置运行 控制器
	 protected function initialize()
    {
        
    }
    
    public function hello()
    {
        return 'hello';
    }
    
    public function data()
    {
        return 'data';
    }
}










 ?>