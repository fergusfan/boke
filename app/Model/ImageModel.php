<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
    protected $table = 'blog_image';
    public $timestamps = false;
    //插入幻灯片
    public function insertImage($data)
    {
        $res = self::insert($data);
        //dd($res);
        return $res;
    }
        //查询所有的幻灯片
        public function getImages()
    {
        $res = self::get()->toArray();
        return $res;
    }

    //获取一条幻灯片信息
    public function getImage($id)
    {
        return self::find($id)->toArray();
    }

    //更新幻灯片数据
    public function upImage($id,$data)
    {
        return self::where('id',$id)->update($data);
    }

    //删除幻灯片
    public function delImage($id)
    {
        return self::destroy($id);
    }

    //按顺序获取幻灯片
    public function getImagesBySort()
    {
        return self::select('url','img_url')->orderBy('sort','asc')->get()->toArray();
    }
}
