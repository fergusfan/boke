<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ArticleModel;

class CommentController extends Controller
{
    public function index()
    {
        $ArticleModel = new ArticleModel();
        $comments = $ArticleModel->getAllComments();

        return view('admin.comment.index',['comments'=>$comments]);
    }

    public function delCom($id)
    {
        //dd($id);
        $ArticleModel = new ArticleModel();
        $res = $ArticleModel->delComment($id);
        if ($res)
        {
            return['msg'=>'删除成功','status'=>'success'];
        }else{
            return['msg'=>'删除失败','status'=>'fail'];
        }
    }
}
