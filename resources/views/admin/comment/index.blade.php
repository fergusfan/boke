@extends('admin.layout.layout')
<link href="https://cdn.bootcss.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
@section('content')
  <body>
<form method="post" action="">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 留言管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="submit" class="button border-red"><span class="icon-trash-o"></span> 批量删除</button>
        </li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="120">ID</th>
        <th>姓名</th>
        <th>文章标题</th>
        <th width="25%">内容</th>
         <th width="240">留言时间</th>
        <th>操作</th>
      </tr>

        @foreach($comments as $comment)
        <tr>
          <td><input type="checkbox" name="id[]" value="1" />
            {{$loop->iteration}}</td>
          <td>{{$comment->username}}</td>
           <td>{{$comment->title}}</td>
          <td>{{$comment->content}}</td>
          <td>{{date('Y-m-d H:i:s',$comment->created_at)}}</td>
          <td><div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="delCom({{$comment->id}})">
                 删除</a> </div></td>
        </tr>
        @endforeach


      {{--
        <tr>
          <td><input type="checkbox" name="id[]" value="1" />
            1</td>
          <td>神夜</td>
          <td>13420925611</td>
          <td>564379992@qq.com</td>
           <td>深圳市民治街道</td>
          <td>这是一套后台UI，喜欢的朋友请多多支持谢谢。</td>
          <td>2016-07-01</td>
          <td><div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="return del(1)"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr>
          <tr>
          <td><input type="checkbox" name="id[]" value="1" />
            1</td>
          <td>神夜</td>
          <td>13420925611</td>
          <td>564379992@qq.com</td>
           <td>深圳市民治街道</td>
          <td>这是一套后台UI，喜欢的朋友请多多支持谢谢。</td>
          <td>2016-07-01</td>
          <td><div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="return del(1)"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr>
          <tr>
          <td><input type="checkbox" name="id[]" value="1" />
            1</td>
          <td>神夜</td>
          <td>13420925611</td>
          <td>564379992@qq.com</td>
           <td>深圳市民治街道</td>
          <td>这是一套后台UI，喜欢的朋友请多多支持谢谢。</td>
          <td>2016-07-01</td>
          <td><div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="return del(1)"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr>
          <tr>
          <td><input type="checkbox" name="id[]" value="1" />
            1</td>
          <td>神夜</td>
          <td>13420925611</td>
          <td>564379992@qq.com</td>
           <td>深圳市民治街道</td>
          <td>这是一套后台UI，喜欢的朋友请多多支持谢谢。</td>
          <td>2016-07-01</td>
          <td><div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="return del(1)"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr>--}}
      <tr>
        <td colspan="8">{{$comments->links()}}</td>
      </tr>
    </table>
  </div>
</form>


<script type="text/javascript">

/*function del(id){
	if(confirm("您确定要删除吗?")){

	}
}

$("#checkall").click(function(){
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {
		Checkbox=true;
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false;
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}*/


function delCom(id)
{
    /*小弹窗看是否传过来用户id*/
    //alert(id);


    var _token = "{{csrf_token()}}"
    //alert(_token);
    /*弹出框显示图片id*/
    //alert(id);
    /*弹出确定框询问是否要删除幻灯片,点击确定后跳转到function函数*/
    layer.confirm('你确定要删除此评论吗??',function ()
    {
        //返回图片对应的id
        //alert(id);
        $.ajax({
            type:'delete',
            url:'/admin/delcom/'+id,
            datatype:'json',
            data:{_token:_token},
            success:function (res) {
                if(res.status=='success'){
                    window.parent.location.href="{{url('admin/index')}}";
                }else{
                    layer.msg(res.msg,{icon:2});
                }

            }


        })
    })
}


</script>
</body>
@endsection