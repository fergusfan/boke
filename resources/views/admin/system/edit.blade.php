@extends('admin.layout.layout')
@section('content')

<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 网站信息</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="javascript:;">{{--action的值为javascript:;时页面不会跳转走--}}

    {{--设置id隐藏域hidden，用户无法看见，但id值传递--}}
      <input type="hidden" class="input" id="id" name="id"  value="{{$sys['id']}}" />

      <div class="form-group">
        <div class="label">
          <label>网站标题：</label>
        </div>
        <div class="field">
          {{--加上disabled属性，内容变为固定不可编辑--}}
          <input type="text" class="input" id="title" name="title"  value="{{$sys['title']}}" />
          <div class="tips"></div>
        </div>
      </div>


      {{--<div class="form-group">
        <div class="label">
          <label>网站LOGO：</label>
        </div>
        <div class="field">
          <input type="text" id="url1" name="slogo" class="input tips" style="width:25%; float:left;" value="" data-toggle="hover" data-place="right" data-image=""  />
          <input type="button" class="button bg-blue margin-left" id="image1" value="+ 浏览上传" >
        </div>
      </div>--}}


      <div class="form-group">
        <div class="label">
          <label>网站域名：</label>
        </div>
        <div class="field">
          <input type="text" class="input" id="url" name="url"  value="{{$sys['url']}}" />
        </div>
      </div>


      <div class="form-group" style="display:none">
        <div class="label">
          <label>副加标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input" id="subhead" name="subhead"  value="{{$sys['subhead']}}" />
          <div class="tips"></div>
        </div>
      </div>


      <div class="form-group">
        <div class="label">
          <label>网站关键字：</label>
        </div>
        <div class="field">
          <textarea class="input" id="keywords" name="keywords" style="height:80px" >{{$sys['keywords']}}</textarea>
          <div class="tips"></div>
        </div>
      </div>


      <div class="form-group">
        <div class="label">
          <label>网站描述：</label>
        </div>
        <div class="field">
          <textarea class="input" id="description" name="description" >{{$sys['description']}}</textarea>
          <div class="tips"></div>
        </div>
      </div>


      <div class="form-group">
        <div class="label">
          <label>作者：</label>
        </div>
        <div class="field">
          <textarea class="input" id="edithor" name="edithor value=" >{{$sys['edithor']}}</textarea>
          <div class="tips"></div>
        </div>
      </div>


      <div class="form-group">
        <div class="label">
          <label>联系人：</label>
        </div>
        <div class="field">
          <input type="text" class="input" id="name" name="name"  value="{{$sys['name']}}" />
          <div class="tips"></div>
        </div>
      </div>


      <div class="form-group">
        <div class="label">
          <label>手机：</label>
        </div>
        <div class="field">
          <input type="text" class="input" id="phone" name="phone"  value="{{$sys['phone']}}" />
          <div class="tips"></div>
        </div>
      </div>


      <div class="form-group">
        <div class="label">
          <label>电话：</label>
        </div>
        <div class="field">
          <input type="text" class="input" id="telephone" name="telephone"  value="{{$sys['telephone']}}" />
          <div class="tips"></div>
        </div>
      </div>


      {{--<div class="form-group" style="display:none;">
        <div class="label">
          <label>400电话：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="s_400" value="" />
          <div class="tips"></div>
        </div>
      </div>--}}


      {{--<div class="form-group">
        <div class="label">
          <label>传真：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="s_fax" value="" />
          <div class="tips"></div>
        </div>
      </div>--}}


      <div class="form-group">
        <div class="label">
          <label>QQ：</label>
        </div>
        <div class="field">
          <input type="text" class="input" id="qq" name="qq"  value="{{$sys['qq']}}" />
          <div class="tips"></div>
        </div>
      </div>


      {{--<div class="form-group" style="display:none">
        <div class="label">
          <label>QQ群：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="s_qqu" value="" />
          <div class="tips"></div>
        </div>
      </div>--}}


      <div class="form-group">
        <div class="label">
          <label>Email：</label>
        </div>
        <div class="field">
          <input type="text" class="input" id="email" name="email"  value="{{$sys['email']}}" />
          <div class="tips"></div>
        </div>
      </div>


      <div class="form-group">
        <div class="label">
          <label>地址：</label>
        </div>
        <div class="field">
          <input type="text" class="input" id="address" name="address"   value="{{$sys['address']}}" />
          <div class="tips"></div>
        </div>
      </div>  


      <div class="form-group">
        <div class="label">
          <label>底部信息：</label>
        </div>
        <div class="field">
          <textarea id="footer" name="footer" class="input" style="height:120px;" >{{$sys['footer']}}</textarea>
          <div class="tips"></div>
        </div>
      </div>


      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button id="sub" class="button bg-main icon-check-square-o" type="submit"> 保存 </button>
        </div>
      </div>

    </form>
  </div>
</div>
</body>
  
  {{--jquery方式提交表单--}}

  <script>
    /*通过id="sub"监控按钮点击状态,点击后运行post*/
    $('#sub').click(function()
    {
        //alert('123456');
        //获取各字段值通过id--id=title
        var id= $('#id').val();
        var title = $('#title').val();
        var url = $('#url').val();
        var subhead = $('#subhead').val();
        var keywords = $('#keywords').val();
        var description = $('#description').val();
        var edithor = $('#edithor').val();
        var name = $('#name').val();
        var phone = $('#phone').val();
        var telephone = $('#telephone').val();
        var qq = $('#qq').val();
        var email = $('#email').val();
        var footer = $('#footer').val();
        var address = $('#address').val();

        //ajax的post提交表单需要_token
        var _token = "{{csrf_token()}}";
      {{--post(提交地址，传递的信息{字段name,字段值}，回调函数)--}}
        $.post("{{url('admin/system/update')}}",{ title:title,url:url,subhead:subhead,keywords:keywords,
          description :description, edithor:edithor,name:name,phone:phone,telephone:telephone,qq:qq,email:email,
          footer:footer,address:address,_token:_token,id:id},function (res)
            {
                if(res.status=='success'){

                    window.parent.location.href="{{url('admin/index')}}";
                }else{
                    layer.msg(res.msg,{icon:2});
                }
        });
    })

  </script>
  
@endsection