<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class ArticleModel extends Model
{
    protected $table = 'blog_article';
    protected $dateFormat = 'U';
    //插入文章
    public function insertArticle($data)
    {
        //dd($data);
        $this->title=$data['title'];
        $this->cat_id=$data['cat_id'];
        $this->keywords=$data['keywords'];
        $this->author=$data['author'];
        $this->img_url=$data['img_url'];
        $this->desc=$data['desc'];
        $this->content=$data['content'];
        $res = $this->save();

        return $res;

    }

    //获取文章列表
    public function getArts()
    {
        //通过DB实现多表连接查询
      $res = DB::table('blog_article as a')->join('blog_cat as c','a.cat_id','=','c.id')
          ->select('a.id','a.title','a.img_url','a.views','a.updated_at','c.cat_name')
          ->orderBy('a.id','desc')->paginate(2);/*paginate(2)为分页显示，2表示每页显示两条*/
      return $res;
    }

    //删除文章
    public function delArticle($id)
    {
        return self::destroy($id);
    }

    //获取一个文章
    public function getArticle($id)
    {
        return self::find($id)->toArray();
    }

    //更新文章
    public function upArticle($id,$data)
    {
        return self::where('id',$id)->update($data);
    }

    //获取文章关键词
    public function getArticlekey()
    {
        /*pluck方法获取一列的值*/
        return self::pluck('keywords')->toArray();
    }

    //获取首页文章列表
    public function getIndexArt()
    {
        return self::select('title','desc','id','img_url')->orderBy('id','desc')->paginate(6);
    }

    //获取最新文章
    public function getNewArts()
    {
        return self::select('title','id')->orderBy('id','desc')->get(5)->toArray();
    }

    //获取文章分类
    public function getArtByCat($id)
    {
        return self::where('cat_id',$id)->select('title','desc','img_url','id')->orderBy('id','desc')->paginate(2);
    }

    //获取文章
    public function getArt($id)
    {
        $res = self::find($id);
        if ($res)
        {
            return $res->toArray();
        }else{
            return ['status'=>'fail'];
        }

    }

    //文章阅读数+1
    public function viewInc($id)
    {
        self::where('id',$id)->increment('views');
    }

    //获取上一篇文章
    public function getPreArt($id)
    {
        $res = self::where('id','<',$id)->select('id','title')->orderBy('id','desc')->first();
        return $res;
    }

    //获取下一篇文章
    public function getNextArt($id)
    {
        $res = self::where('id','>',$id)->orderBy('id','desc')->first();
        return $res;
    }

    //插入用户点赞
    public function insertLike($username,$id)
    {
        $user_id = DB::table('blog_user')->where('username',$username)->value('id');

        $res= DB::table('blog_likes')->insert(['user_id'=>$user_id,'art_id'=>$id]);

       if ($res){
           self::where('id',$id)->increment('likes');
           return self::where('id',$id)->value('likes');
       }

    }

    //判断用户是否已经点赞
    public function checkLike($username,$id)
    {
        $user_id = DB::table('blog_user')->where('username',$username)->value('id');

        $res = DB::table('blog_likes')->where('user_id',$user_id)->where('art_id',$id)->first();
        //dd($res);
        if ($res){
            return false;
        }else{
            return true;
        }
    }

    //插入文章评论
    public function insertComment($data)
    {
        return DB::table('blog_comments')->insert($data);
    }

    //获取文章评论内容
    public function getComments($id)
    {
        return DB::table('blog_comments')->where('art_id',$id)->get()->toArray();
    }

    //获取文章评论内容条数
    public function getCommentNum($id)
    {
        return DB::table('blog_comments')->where('art_id',$id)->count();
    }

    //获取所有文章评论
    public function getAllComments()
    {
        $res = DB::table('blog_comments as c')->join('blog_article as a','c.art_id','=','a.id')
            ->select('c.id','c.username','c.content','c.created_at','a.title')->orderBy('c.id','desc')->paginate(3);
        //dd($res);
        return $res;
    }

    //删除文章一条评论
    public function delComment($id)
    {
        return DB::table('blog_comments')->where('id',$id)->delete();
    }

    //搜索文章
    public function searchArt($keywords)
    {
        //self::where('title','like',"%{$keywords}%")->orwhere('content','like',"%{$keywords}%")
        //            ->select('title','id','desc','img_url')->get()->toArray();
        $res = self::where('title','like','%'.$keywords.'%')->orWhere('content','like','%'.$keywords.'%')
            ->select('title','id','desc','img_url')->get()->toArray();
        //dd($res);
        return $res;
    }

}
