<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CatModel;
use App\Model\ArticleModel;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleModel = new ArticleModel();
        $articles= $articleModel->getArts();
        return view('admin.article.index',['articles'=>$articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //调用catModel中getCats方法，获取分类名
        $catModel = new CatModel();
        $cats = $catModel->getCats();
        return view('admin.article.add',['cats'=>$cats]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->except('_token');
        $articleModel = new ArticleModel();
        $res = $articleModel->insertArticle($data);
        if ($res)
        {
            return['msg'=>'插入成功','status'=>'success'];
        }else{
            return['msg'=>'插入失败','status'=>'fail'];
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        $catModel = new CatModel();
        $cats = $catModel->getCats();

        $articleModel = new ArticleModel();
        $article = $articleModel->getArticle($id);

        return view('admin.article.edit',['article'=>$article,'cats'=>$cats]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dump($id);
       $data= $request->except('_token','_method');

        $articleModel = new ArticleModel();
        $res = $articleModel->upArticle($id,$data);
        if ($res)
        {
            return['msg'=>'修改成功','status'=>'success'];
        }else{
            return['msg'=>'修改失败','status'=>'fail'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        $articleModel = new ArticleModel();
        $res = $articleModel->delArticle($id);
        if ($res)
        {
            return['msg'=>'删除成功','status'=>'success'];
        }else{
            return['msg'=>'删除失败','status'=>'fail'];
        }
    }

    public function upload(Request $request)
    {
        //获取图片上传信息
        $image  = $request->file('file');

        if ($image->isValid())
            //验证图片合法性Valid
        {
            //验证图片扩展名和规格
            $ext = $image ->getClientOriginalExtension();
            $size = $image ->getClientSize();

            //验证图片格式和大小
            $allow_ext = ['gif','jpg','jpeg','bmp','png'];
            $allow_size = 1024*1024*2;

            //判断图片名和图片格式不在数组内或者图片格式大小大于设置的最大要求，则图片无法上传
            if(!in_array($ext,$allow_ext)||$size>$allow_size)
            {
                return 'fail';
            }
            //存储位置为public/uploads/下以时间Y-m-d命名文件夹下
            $img_path = 'upload/article/'.date('Y-m-d');
            //图片名称按当前时间戳和图片扩展名命名
            $img_name = time().'.'.$ext;
            //图片上传成功后返回图片名称和地址
            if($image->move($img_path ,$img_name))
            {
                //return $img_path.'/'.$img_name;
                $url = '/'.$img_path.'/'.$img_name;
                return ['errno'=>0,'data'=>[$url]];
            }

            return 'fail';


        }

    }
}
