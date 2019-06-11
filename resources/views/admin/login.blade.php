@extends('admin.layout.layout')
@section('content')
    <body>
    <div class="bg"></div>
    <div class="container">
        <div class="line bouncein">
            <div class="xs6 xm4 xs3-move xm4-move">
                <div style="height:150px;"></div>
                <div class="media media-y margin-big-bottom">
                </div>
                <form id="form" action="{{url('admin/toLogin')}}" method="post">
                    {{csrf_field()}}
                    <div class="panel loginbox">
                        <div class="text-center margin-big padding-big-top"><h1>后台管理中心</h1></div>
                        <div class="panel-body" style="padding:30px; padding-bottom:10px; padding-top:10px;">
                            <div class="form-group">
                                <div class="field field-icon-right">
                                    <input type="text" class="input input-big" name="admin_name" placeholder="登录账号" datatype="s4-10" />
                                    {{--<span class="icon icon-user margin-small"></span>--}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="field field-icon-right">
                                    <input type="password" class="input input-big" name="admin_pass"
                                           placeholder="登录密码" datatype="s4-8" />
                                    {{--<span class="icon icon-key margin-small"></span>--}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="field">
                                    <input type="text" class="input input-big" datatype="s4-4" name="code"
                                           placeholder="填写右侧的验证码" data-validate="required:请填写右侧的验证码" />
                                    <img src="{{captcha_src()}}" alt="" width="100" height="32" class="passcode"
                                         style="height:43px;cursor:pointer;" onclick="this.src=this.src+'?'">

                                </div>
                            </div>
                        </div>
                        <div style="padding:30px;"><input type="submit" class="button button-block bg-main text-big input-big"
                                                          value="登录"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </body>

    <script>
        $('#form').Validform({
            //验证码长度为4
            tiptype:4,
            //ajax请求
            ajaxPost:true,
            //页面返回信息
            callback:function(res){
                if(res.status=='success'){
                    location.href="{{url('admin/index')}}";
                }else{
                    layer.msg(res.msg,{icon:2});//返回信息为红色叉号
                }
            }

        });
    </script>
@endsection
