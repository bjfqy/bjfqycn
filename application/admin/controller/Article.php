<?php

namespace app\admin\controller;

use think\Controller;
use think\facade\Request;
use app\admin\model\Acate;
use app\admin\model\Article as ac;

class Article extends Controller
{
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

        //dump($res);

         if (Request::isAjax()) {
            # code...
            
            $res = Request::param();

            if (is_null($res['image'])) {
                # code...
                return ['sus'=>0,'msg'=>$sus];
            }

            $res['image']=implode('|', $res['image']);

            $sus=ac::update($res);

            //dump($sus);
            if ($sus) {
                # code...
                return ['code'=>1,'msg'=>'更新成功'];
            }
            
            return ['code'=>0,'msg'=>'服务器失败'];
        }


        
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



    /**文章新增
     * 
     *
     * @return \think\Response
     */
    public function create()
    {
        //
        
        $res=Acate::getCate();

        $this->assign('cate',$res);
        return $this->fetch();
        
    }


    



    /**
     * 显示资源列表 
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $res= ac::where('status',1)->field('id,title,image,pid,click,update_time')->order('id','desc')->paginate(50);
        
        //dump($res);
        $this->assign('pro',$res);

        return $this->fetch();
        
    }

    
    /**分类保存
     * 
     *
     * @return \think\Response
     */
    public function catesave()
    {
        //
        $res = Request::param();

        $msg=Acate::create($res);

        if ($msg) {
            # code...
            return ['sus'=>1];
        }
        return ['sus'=>0 , 'msg'=>$msg];      
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
           $msg= Acate::destroy($res);

            if ($msg) {
            # code...
            return ['sus'=>1];
            }
           
        }

        return ['sus'=>0 , 'msg'=>'顶级类目不允许删除'];

       
        
        
    }




 /**
 * 显示创建资源表单页.
 *
 * @return \think\Response
 */
    public function catecreate()
    {
        //
        $res = Acate::getCate();

        $this->assign('cate',$res);

        return $this->fetch();
        
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
        ////
        //dump(Request::param());

        if (Request::isAjax()) {
            # code...


            $res=Request::param();

            $res= ac::where('title',$res['title'])->find();

            if ($res) {
                return ['code'=>0,'msg'=>'请勿重复提交'];
            }else{


                if (empty($res['image'])) {
                # code...
                return ['code'=>0,'msg'=>'请添加图片'];
                }else{

                    $res['image']=implode('|', $res['image']);

                    $sus=ac::create($res);
                   
                   if ($sus) {
                       # code...
                    return ['code'=>1,'msg'=>'成功'];
                   }
                   return['code'=>0,'msg'=>$sus];
                }

            }

            

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
        $res= ac::find($id);
       $cate=Acate::field('catename,id,pid')->select();

    

       //dump($res);
       $this->view->assign([
                 'pro'=>$res,
                 'cate'=>$cate,
                 

       ]);

       return $this->fetch();

    }



    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete()
    {
       $res = Request::param();
       //dump($res);

      $sus= ac::destroy($res);

      if($sus){

        return ['code'=>1 ,'msg'=>'删除成功'];
      }

      return ['code'=>0, 'msg'=>'删除失败请检查'];
    }
}
