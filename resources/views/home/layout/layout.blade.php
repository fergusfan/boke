<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>{{$sys['title']}}</title>
    <meta name="keywords" content={{$sys['keywords']}} />
    <meta name="description" content={{$sys['description']}} />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{asset('/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('/home/css/info.css')}}" rel="stylesheet">
    <link href="{{asset('/home/css/m.css')}}" rel="stylesheet">
    <link href="{{asset('/home/css/login.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/lib/validform/css/style.css')}}">


    <script src="{{asset('/home/js/jquery.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('/home/js/comm.js')}}"></script>
    <script type="text/javascript" src="{{asset('/home/js/slidr.js')}}"></script>
    <script src="{{asset('/lib/validform/js/Validform_v5.3.2_min.js')}}"></script>
    <script src="{{ asset('/lib/layer/layer.js')}}"></script>

    <!--[if lt IE 9]>
    <script src="js/modernizr.js"></script>
    <![endif]-->



</head>
<body>
<header class="header-navigation" id="header">
    <nav><div class="logo"><a href="{{url('/')}}">智慧医疗</a></div>
        <h2 id="mnavh"><span class="navicon"></span></h2>
        <ul id="starlist">
            <li><a href="{{url('/')}}">首页</a></li>

            @foreach($cats as $cat)
            <li><a  href="{{url('cat/'.$cat['id'])}}">{{$cat['cat_name']}}</a></li>
            @endforeach

            @if(!session('user'))
                <li><a href="{{url('login')}}" class="btn btn-default login-btn no-pjax">登 录</a></li>
                <li>  <a href="{{url('register')}}" class="btn btn-default login-btn no-pjax">注 册</a></li>
            @else
                <li><a href="javascript:;" class="btn btn-default login-btn no-pjax">欢迎您：{{session('user')}} 登录</a></li>
                <li>  <a href="{{url('logout')}}" class="btn btn-default login-btn no-pjax">退 出</a></li>
            @endif

        </ul>
    </nav>
</header>





@section('content')
    @show


<footer id="footer" >
    <p>Powerd By  <a href="http://www.lampol-blog.com" target="_blank">lampol</a> <a href="/">{{$sys['footer']}}</a></p>
</footer>
<a href="#" class="cd-top">Top</a>
<script>
    slidr.create('slidr-img').start();
</script>
</body>
</html>
