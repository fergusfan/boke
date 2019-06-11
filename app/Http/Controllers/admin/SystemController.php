<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SystemModel;

class SystemController extends Controller
{
    public function index()
    {
        $systemModel = new SystemModel;
        $sys = $systemModel -> getSys();
        //网站设置好后返回数据到前台显示
        return view('admin/system/index',['sys'=>$sys]);
    }

    public function edit(){
        $systemModel = new SystemModel;

        $sys = $systemModel->getSys();

        return view('admin.system.edit',['sys'=>$sys]);
    }


    public  function update(Request $request){

        //except作用：获取字段时去除某一个字段
        $data = $request->except('_token');
        //dd($request->input());

        $systemModel = new SystemModel;

        $res = $systemModel->upSys($data);

        //dd($data);

        if($res){
            return ['msg'=>"修改成功",'status'=>'success'];
        }else{
            return ['msg'=>'修改失败','status'=>'fail'];
        }

    }
}
