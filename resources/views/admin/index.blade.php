@extends('admin.layout.layout')
@section('content')
  <body style="background-color:#f2f9fd;">
  <div class="header bg-main">
    <div class="logo margin-big-left fadein-top">
      <h1><img src="{{ asset('admin/images/y.jpg')}}" class="radius-circle rotate-hover" height="50" alt="" />后台管理中心</h1>
    </div>
    <div class="head-l"><a class="button button-little bg-green" href="{{url('/')}}" target="_blank"> 前台首页</a>
      &nbsp;&nbsp; &nbsp;&nbsp;<a class="button button-little bg-red" href="{{url('admin/logout')}}">退出登录</a> </div>
  </div>
  <div class="leftnav">
    <div class="leftnav-title"><strong>菜单列表</strong></div>
    <h2>基本设置</h2>
    <ul style="display:block">
      <li><a href="{{url('admin/system')}}" target="right">网站设置</a></li>

    </ul>
    <h2>文章管理</h2>
    <ul>
      <li><a href="{{url('admin/article')}}" target="right">文章列表</a></li>
      <li><a href="{{url('admin/article/create')}}" target="right">添加文章</a></li>
    </ul>


    <h2>用户管理</h2>
    <ul>
      <li><a href="{{url('admin/pass')}}" target="right">修改密码</a></li>
      <li><a href="{{url('admin/user')}}" target="right">用户列表</a></li>
      <li><a href="{{url('admin/comment')}}" target="right">留言管理</a></li>
    </ul>



    <h2>分类管理</h2>
    <ul>
      <li><a href="{{url('admin/cat')}}" target="right">分类列表</a></li>
      <li><a href="{{url('admin/cat/create')}}" target="right">分类添加</a></li>
    </ul>

    <h2>幻灯片</h2>
    <ul>
      <li><a href="{{url('admin/image')}}" target="right">图片列表</a></li>
      <li><a href="{{url('admin/image/create')}}" target="right">添加图片</a></li>
    </ul>

    <h2>友情链接</h2>
    <ul>
      <li><a href="{{url('admin/link')}}" target="right">连接列表</a></li>
      <li><a href="{{url('admin/link/create')}}" target="right">添加连接</a></li>
    </ul>


  </div>

  <script type="text/javascript">
      $(function(){
          $(".leftnav h2").click(function(){
              $(this).next().slideToggle(200);
              $(this).toggleClass("on");
          })
          $(".leftnav ul li a").click(function(){
              $("#a_leader_txt").text($(this).text());
              $(".leftnav ul li a").removeClass("on");
              $(this).addClass("on");
          })
      });
  </script>
  <ul class="bread">
    <li><a href="{:U('Index/info')}" target="right" class="icon-home"> 首页</a></li>
    <li><a href="##" id="a_leader_txt">网站信息</a></li>
    <li><b>当前语言：</b><span style="color:red;">中文</span>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;切换语言：<a href="##">中文</a> &nbsp;&nbsp;<a href="##">英文</a> </li>
  </ul>
  <div class="admin">
    <iframe scrolling="auto" rameborder="0" src="{{url('admin/system')}}" name="right" width="100%" height="100%"></iframe>
  </div>
  <div style="text-align:center;">
    <p>来源:<a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>
  </div>
  </body>
@endsection