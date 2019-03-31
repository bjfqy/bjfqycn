<?php

namespace app\admin\controller;


use think\facade\Request;
use app\admin\model\Pcate;
use app\admin\model\Product as pro;

class Product extends Base
{
    /**
     * 显示资源列表 产品列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //现在用all后期需要调整和修改
        $res=pro::field('id,pid,title,price,image,update_time')->order('id','desc')->paginate(50);
        //dump($res);
        $this->assign('pro',$res);
        return $this->fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function catecreate()
    {
        //

        // $cate=Pcate::field('catename,id,pid')->select();
        $cate=Pcate::getCate();

        $this->assign('cate',$cate);


        return $this->fetch();
    }

    /**
     * 图片上传 post接口
     *
     * @return \think\Response
     */


    public function upload()
    {
        # code...
        $file=Request::file('file');

         $info = $file->move( '../public/uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            //echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            $dest= $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            //echo $info->getFilename(); 

            return ['code'=>0, 'dest'=>$dest ];
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }




    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
        $cate=Pcate::field('catename,id,pid')->select();
        

        $this->assign('cate',$cate);


        return $this->fetch();
    }

    /**
     * 保存新建的资源 分类保存
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function catesave()
    {

        //$res = Request::param();

        //dump($res);
        //判断是否为ajax 提交过来的数据
        if (Request::isAjax()) {
            # code...
            $acate=Request::post();
            

            $sus=Pcate::where('catename',$acate['catename'])->find();
            if ($sus) {
                # code...
                return['sus'=>0,'msg'=>'类目已存在'];
            }else{
                $res=Pcate::create(Request::post());

                if ($res) {
                    # code...
                   return['sus'=>1,'msg'=>'类目增加成功'];
                }
                return ['sus'=>0,'msg'=>'通信异常'];

            }
            
        }
    }

    /**显示创建资源表单页.
     * 
     *
     * @return \think\Response
     */
    public function catedel()
    {
        //
        $res = Request::param();

        if ($res['id']>0) {
            # code...
           $msg= Pcate::destroy($res);

            if ($msg) {
            # code...
            return ['sus'=>1];
            }
           
        }

        return ['sus'=>0 , 'msg'=>'顶级类目不允许删除'];

       
        
        
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        //

        if (Request::isAjax()) {
            # code...


            $res=Request::param();

            $res['image']=implode('|', $res['image']);

            $sus=pro::create($res);
           
           if ($sus) {
               # code...
            return ['code'=>1,'msg'=>'成功'];
           }
           return['code'=>0,'msg'=>$sus];
        }
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
       $res= pro::find($id);
       $cate=Pcate::field('catename,id,pid')->select();

    

       //dump($res);
       $this->view->assign([
                 'pro'=>$res,
                 'cate'=>$cate,
                 

       ]);

       return $this->fetch();

    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update()
    {
        //
        $res = Request::param();



        if (Request::isAjax()) {
            # code...
            
            $res = Request::param();

            if (is_null($res['image'])) {
                # code...
                return ['sus'=>0,'msg'=>$sus];
            }

            $res['image']=implode('|', $res['image']);

            $sus=pro::update($res);

            if ($sus) {
                # code...
                return ['sus'=>1];
            }
            
        }
        
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete()
    {
        //
        $id = Request::param();



        $res=pro::destroy($id);

        if ($res) {
            # code...

            return ['code'=>1,'msg'=>'删除成功'];
        }
        
        return ['code'=>0,'msg'=>$res];
    }
}
