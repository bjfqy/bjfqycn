<?php
namespace app\admin\controller;

use app\admin\model\Article;
use app\admin\model\Product;
use app\admin\model\Download;
use app\admin\controller\Base;


class Index extends Base
{
    public function index()
    {
        return $this->fetch('');
    	$res=Article::find(1);
    	dump($res);
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    public function welcome()
    {
        $info = array(
        '操作系统'=>PHP_OS,
        '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
        'PHP运行方式'=>php_sapi_name(),
        '当前PHP版本'=>substr(PHP_VERSION,0,3),

        'ThinkPHP版本'=>\think\facade\App::version(),
        '上传附件限制'=>ini_get('upload_max_filesize'),
        '执行时间限制'=>ini_get('max_execution_time').'秒',
        '服务器时间'=>date("Y年n月j日 H:i:s"),
        '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
        '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
        '剩余空间'=>round((disk_free_space(".")/(1024*1024)),2).'M',
        'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
        'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
        'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
        );

       // dump($info);


        # code...
        $acount=Article::count();
        $pcount=Product::count();
        $dcount=Download::count();
        $this->assign([
            'acount'=>$acount,
            'pcount'=>$pcount,
            'dcount'=>$dcount,
            'info'=>$info,

        ]);

        
        return $this->fetch();
    }
    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
