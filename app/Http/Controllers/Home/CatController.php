<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ArticleModel;

class CatController extends Controller
{
    public function index($id)
    {
       /* dd($id);*/
        $ArticleModel = new ArticleModel();
        $articles = $ArticleModel->getArtByCat($id);
       return view('home.article.index',['articles'=>$articles]);
    }
}
