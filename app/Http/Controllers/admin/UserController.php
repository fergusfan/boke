<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AdminModel;
use App\Model\UserModel;

class UserController extends Controller
{
    //
    public function index(){
        $UserModel = new UserModel();
        $users = $UserModel->getUsers();


        return view('admin.user.index',['users'=>$users]);
    }

    //修改密码
    public function pass(Request $request){

        if($request->isMethod('post')){
            $new_pass = trim($request->input('newpass'));
            $username = session('username');
            //模型修改密码
            $admin_model = new AdminModel;

            $res = $admin_model->upadatePass($username,$new_pass);

            if($res){
                return ['msg'=>'修改密码成功','status'=>'success'];
            }else{
                return ['msg'=>'修改密码失败','status'=>'fail'];
            }

        }
        return view('admin.user.pass');
    }

    //冻结用户
    public function freeze($id)
    {
        //dd($id);
        $UserModel = new UserModel();
        $res = $UserModel->freezeUser($id);

        if($res){
            return ['msg'=>'冻结成功','status'=>'success'];
        }else{
            return ['msg'=>'冻结失败','status'=>'fail'];
        }

    }
}
