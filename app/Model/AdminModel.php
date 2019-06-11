<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $table = 'blog_admin';
    public $timestamps = false;//不让更新时自动更新时间字段

    public function checkLogin($admin_name,$admin_pass){

        $user = self::where('admin_name',$admin_name)->select('admin_pass','salt')->first();
        if(!$user){
            return ['msg'=>'没有此用户名','status'=>'fail'];
        }

        $user = $user->toArray();

        $pass1 = md5($admin_pass.$user['salt']);

        if($user['admin_pass']==$pass1){
            return ['msg'=>'登陆成功','status'=>'success'];
        }

        return ['msg'=>'密码不正确','status'=>'fail'];


    }


    //检测用户密码是否正确

    public function checkPass($username,$password){
        $res =  $this->checkLogin($username,$password);
        return $res;
    }

    //更新管理员密码

    public function upadatePass($username,$new_pass){
        //用于密码加密的盐为随机六位字符串
        $salt = str_random(6);
        //md5加密
        $admin_pass = md5($new_pass.$salt);
        //把admin_name对应username的密码和盐更新
        $res =  self::where('admin_name',$username)->update(['salt'=>$salt,'admin_pass'=>$admin_pass]);

        //dd($res);
        return $res;

    }
}
