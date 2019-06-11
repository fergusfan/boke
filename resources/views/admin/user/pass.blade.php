@extends('admin.layout.layout')
@section('content')
  <body>
  <div class="panel admin-panel">
    <div class="panel-head"><strong><span class="icon-key"></span> 修改会员密码</strong></div>
    <div class="body-content">
      <form method="post" id="form" class="form-x" action="{{url('admin/pass')}}">
        {{csrf_field()}}{{--发送post请求必须加上--}}
        <div class="form-group">
          <div class="label">
            <label for="sitename">管理员帐号：</label>
          </div>
          <div class="field">
            <label style="line-height:33px;">
              {{session('username')}}
            </label>
          </div>
        </div>
        <div class="form-group">
          <div class="label">
            <label for="sitename">原始密码：</label>
          </div>
          <div class="field">
            <input type="password" class="input w50" id="mpass" ajaxurl="{{url('admin/checkPass')}}" datatype="s6-10" name="mpass" size="50" placeholder="请输入原始密码"  />
          </div>
        </div>
        <div class="form-group">
          <div class="label">
            <label for="sitename">新密码：</label>
          </div>
          <div class="field">
            <input type="password" class="input w50" name="newpass" size="50" placeholder="请输入新密码" datatype="s6-10" />
          </div>
        </div>
        <div class="form-group">
          <div class="label">
            <label for="sitename">确认新密码：</label>
          </div>
          <div class="field">
            <input type="password" class="input w50" name="renewpass" recheck="newpass" size="50" placeholder="请再次输入新密码" datatype="s6-10" />
          </div>
        </div>

        <div class="form-group">
          <div class="label">
            <label></label>
          </div>
          <div class="field">
            <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  </body>

  <script>
      $('#form').Validform({
          tiptype:4,
          ajaxPost:true,
          callback:function(res){
              if(res.status=='success'){
                 /* 修改密码成功后调用logout方法退出，重新使用新密码登录*/
                  /*window.parent.加上后就不会在原页面的子页面上生成页面*/
                  window.parent.location.href="{{url('admin/logout')}}";
              }else{
                  layer.msg(res.msg,{icon:2});
              }
          }
      });
  </script>
@endsection