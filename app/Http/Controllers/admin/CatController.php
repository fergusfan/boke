<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CatModel;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catModel = new CatModel();
        $cats = $catModel->getCats();
        return view('admin.cat.index',['cats'=>$cats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cat.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->input());
        $catModel = new CatModel();
        $data = $request->except('_token');
        $res = $catModel->insertCat($data);
        if ($res)
        {
            return ['msg'=>'插入成功','status'=>'success'];
        }else{
            return ['msg'=>'插入失败','status'=>'fail'];
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catModel = new CatModel();
        $cat = $catModel->getCat($id);
        return view('admin.cat.edit',['cat'=>$cat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token','_method');
        $catModel = new CatModel();
        $res = $catModel->upCat($id,$data);
        if ($res)
        {
            return ['msg'=>'插入成功','status'=>'success'];
        }else{
            return ['msg'=>'插入失败','status'=>'fail'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catModel = new CatModel();
        $res = $catModel->delCat($id);
        if ($res)
        {
            return ['msg'=>'删除成功','status'=>'success'];
        }else{
            return ['msg'=>'删除失败','status'=>'fail'];
        }
    }
}
