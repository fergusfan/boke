<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Model\AdminModel;

class LoginController extends Controller
{
    //
    public function index(){
        return view('admin.login');
    }
    public function login(Request $request){
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
        //获取用户名 以及密码

        $admin_name = trim($request->input('admin_name'));
        $admin_pass = trim($request->input('admin_pass'));

        // 模型验证用户名密码是否正确

        $admin_model = new AdminModel;

        $res = $admin_model->checkLogin($admin_name,$admin_pass);

        //记录用户的登陆状态

        session(['username'=>$admin_name]);

        return $res;
    }

    //用户退出
    public function logout(){
        //dd('123456');
        session(['username'=>null]);
        //页面跳转至登录界面
        return redirect('admin/login');
    }

    //检测密码

    public function checkPass(Request $request){
        $password = trim($request->input('param'));

        // 模型验证密码是否正确
        $username = session('username');
        $admin_model = new AdminModel;

        $res = $admin_model->checkPass($username,$password);

        //  程序员 最讨厌的 写注释   还有一个讨厌 就是 看别人代码  但是别人没有写注释
        //判断密码是否正确
        if($res['status']=='success'){
            //validform规定返回必须是info
            return ['info'=>'密码正确 可以修改','status'=>'y'];
        }else{
            return ['info'=>'密码不正确','status'=>'n'];
        }

    }


}
