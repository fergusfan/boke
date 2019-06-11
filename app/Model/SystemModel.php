<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SystemModel extends Model
{
    protected $table = 'blog_system';
    public $timestamps = false;//加上以后不会更新时间
    public function getSys()
    {
        return self::first()->toArray();
    }

    public function upSys($data){
        $res = self::where('id',$data['id'])->update($data);

        return $res;
    }
}
