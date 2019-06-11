@extends('home.layout.layout')
@section('content')
 <article>

  <div id="wrap">
   <div class="container main-container ">
    <div class="row">
     <div class="col-md-4 col-md-offset-4 floating-box">
      <div class="panel panel-default">
       <div class="panel-heading">
        <h3 class="panel-title">请登录</h3>
       </div>
       <div class="panel-body">
        <form method="POST" id="form" action="{{url('login')}}" accept-charset="UTF-8">

         {{csrf_field()}}
         <div class="form-group ">
          <label class="control-label" for="username">用户名</label>
          <input class="form-control" name="username" type="text" value="" datatype="s2-10" placeholder="请填写用户名" />
         </div>
         <div class="form-group ">
          <label class="control-label" for="password">密 码</label>
          <input class="form-control" name="password" type="password" datatype="s6-12" value="" placeholder="请填写密码" />
         </div>

         <div class="form-group ">
          <label for="captcha" class="control-label">图片验证码</label>
          <div class="captcha-input">
           <input id="captcha" class="form-control" datatype="s4-4" name="code" placeholder="请填写验证码" required="" autocomplete="off" />
           <br>
           <img src="{{captcha_src()}}" alt="" width="100" height="32" class="passcode" style="height:43px;cursor:pointer;" onclick="this.src=this.src+'?'">
          </div>
         </div>

         <button type="submit" class="btn btn-lg btn-success btn-block"> <i class="fa fa-btn fa-sign-in"></i> 登录 </button>
         <hr />

        </form>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>


 </article>

 <script type="text/javascript">
     $('#form').Validform({
         tiptype:4,
         ajaxPost:true,
         callback:function(res){
             if(res.status=='success'){
                 window.parent.location.href="{{url('/')}}";
             }else{
                 layer.msg(res.msg,{icon:2});
             }
         }

     });

 </script>>

@endsection