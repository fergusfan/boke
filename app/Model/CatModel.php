<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CatModel extends Model
{
    public $timestamps = false;
    protected $table = 'blog_cat';

    //插入分类
    public function insertCat($data)
    {
        return self::insert($data);
    }

    //获取所有分类
    public function getCats()
    {
        return self::get()->toArray();
    }

    //获取一条分类
    public function getCat($id)
    {
        return self::find($id)->toArray();
    }

    //修改分类
    public function upCat($id,$data)
    {
        return self::where('id',$id)->update($data);
    }

    //删除分类
    public function delCat($id)
    {
        return self::destroy($id);
    }
}
