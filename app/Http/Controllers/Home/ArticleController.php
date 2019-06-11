<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ArticleModel;
use Validator;
class ArticleController extends Controller
{
    public function index(){
        return view('home.article.index');
    }

    public function detail($id){
        $ArticleModel = new ArticleModel;

        $article = $ArticleModel->getArt($id);
        //dd($article);


        /*if(isset($article['status']) && $article['status']=='fail'){
            return redirect('/');
        }*/

        if (isset($article['status']) && $article['status']=='fail')
        {
            return redirect('/');
        }

        //调用方法显示上/下一篇文章
        $preArt = $ArticleModel->getPreArt($id);
        $nextArt = $ArticleModel->getNextArt($id);


          //调用方法使阅读数加一
          $ArticleModel->viewInc($id);

          //获取评论内容
         $comments = $ArticleModel->getComments($id);
         //dd($comment);

        //获取文章评论条数
        $num = $ArticleModel->getCommentNum($id);

        return view('home.article.detail',['article'=>$article,'preArt'=>$preArt,'nextArt'=>$nextArt,
            'comments'=>$comments,'num'=>$num]);
    }

    //文章点赞
    public function diggit($id)
    {
        //dd($id);
        //判断用户是否登录
        if (!session('user')){
            return ['status'=>'nologin','msg'=>'你还没登录，请先登录，再来点赞'];
        }

        //判断此用户是否已经对此文章点赞
        //dd('login');
        $ArticleModel = new ArticleModel;

        $username = session('user');

        if(!$ArticleModel->checkLike($username,$id)){
            return ['status'=>'fail','msg'=>'你已点过赞，请不要重复点赞！'];
        }

        $res = $ArticleModel->insertLike($username,$id);
        //dd($res);
        if ($res){
            return ['status'=>'success','msg'=>'点赞成功','num'=>$res ];
        }

    }

    //文章评论
    public function comment(Request $request)
    {
        //判断用户是否登录
        if (!session('user')){
            return ['status'=>'nologin','msg'=>'你还没登录，请先登录，再来评论'];
        }

        //获取验证码trim函数去除空字符
        $code = trim($request->input('code'));

        $rules = ['code' => 'captcha'];
        $message = ['code.captcha'=>'验证码输入不正确'];
        $validator = Validator::make(['code'=>$code], $rules,$message);
        //验证码不正确
        if($validator->fails()){
            $msg = $validator->errors()->first();
            return ['msg'=>$msg,'status'=>'fail'];
        }

        //dd('success');

        $username = session('user');

        $time = time();

        $content = trim($request->input('content'));

        $art_id = $request->input('art_id');

        $data = ['username'=>$username,'created_at'=>$time,'content'=>$content,'art_id'=>$art_id];

        $ArticleModel = new ArticleModel;

        $res = $ArticleModel->insertComment($data);
        //dd($res);
        if ($res)
        {
            return ['msg'=>'评论成功','status'=>'success'];
        }

    }

    public function search(Request $request){
        $keywords = trim($request->input('keywords'));
        $ArticleModel = new ArticleModel;
        $articles = $ArticleModel->searchArt($keywords);

        return view('home.article.search',['articles'=>$articles]);

    }

}
