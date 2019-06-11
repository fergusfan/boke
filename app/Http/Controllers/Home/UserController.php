<?php

namespace App\Http\Controllers\Home;

use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class UserController extends Controller
{
    //登录
    public function login(Request $request){
        if($request->isMethod('post')){

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

            $username = trim($request->input('username'));
            $password = trim($request->input('password'));

            $userModel = new UserModel;

            $res = $userModel->checkUser($username,$password);

            return $res;
        }


        return view('home.user.login');
    }
    //注册
    public function register(Request $request)
    {
        if ($request->isMethod('post'))
        {
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

            $username = trim($request->input('username'));
            $password = trim($request->input('password'));

            $userModel = new UserModel();
            $res = $userModel->insertUser($username,$password);
            if ($res)
            {
                //sesion记录一下状态，成功时将用户名写入session，用于前台导航判断session中是否有用户名，若有，则展示
                session(['user'=>$username]);
                return['msg'=>'注册成功','status'=>'success'];
            }else{
                return['msg'=>'注册失败','status'=>'fail'];
            }
        }
        return view('home.user.register');
    }

    public function checkName(Request $request)
    {
        $username = trim($request->input('param'));

        $userModel = new UserModel();
        $res = $userModel->checkName($username);
        if ($res['status']=='success')
        {
            return ['info'=>'可以注册','status'=>'y'];
        }else{
            return ['info'=>'用户名已存在','status'=>'n'];
        }

    }

    public function logout()
    {
        session(['user'=>null]);
        return redirect('/');
    }
}
