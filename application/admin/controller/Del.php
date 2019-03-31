<?php

namespace app\admin\controller;

use think\Controller;
use think\facade\Request;
use think\facade\Env;
use app\admin\model\Product;
use app\admin\model\Article;

class Del extends Controller
{
    /**
     * 删除图片
     *
     * @return \think\Response
     */
    public function img()
    {
        //
        $res = Request::param();
        //dump($res);
        $delimg=Env::get('root_path').'/public/uploads/'.$res['img'];

        //$img=$res['m']::find($res['id'])->getData('image');
        
        //dump($img);

        $sus=unlink($delimg);
        if ($sus) {
            # code... code=1表示删除成功
            return ['code'=>1];
        }
        return ['msg'=>'服务器通讯异常'];
        
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
