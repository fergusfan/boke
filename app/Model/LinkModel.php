<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LinkModel extends Model
{
    protected $table = 'blog_link';
    public $timestamps = false;
    //插入友情链接
    public function insertLink($data)
    {
        return self::insert($data);
    }

    //获取所有的链接
    public function getLinks()
    {
        return self::get()->toArray();
    }

    //获取一条链接
    public function getLink($id)
    {
        return self::find($id);
    }

    //更新链接
    public function upLink($id,$data)
    {
        return self::where('id',$id)->update($data);
    }

    //删除链接
    public function delLink($id)
    {
        return self::destroy($id);
    }

     //获取链接并且排序
    public function getLinksBySort()
    {
        return self::select('title','url')->orderBy('sort','asc')->get()->toArray();
    }
}
