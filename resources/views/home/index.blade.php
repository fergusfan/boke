@extends('home.layout.layout')
@section('content')

<style type="text/css">
       .page-item{
       display: inline-block;
       }
       </style>

<article>
    {{--将页面左侧一列内容<aside></aside>拿出来放入子视图，在页面引用子视图即可--}}
    @include('home.layout.aside')

    <main class="r_box">

        @if(!empty($images))

        {{--图片幻灯片效果--}}
            <div id="slidr-img" style="display: inline-block">
        @foreach($images as $image)
           {{-- 两种图片跳转方式二选一--}}
            <img data-slidr="{{$loop->iteration}}" onclick='location.href="{{$image['url']}}"'{{--onclick='jump("{{$image['url']}}" )--}}
                    src="{{$image['img_url']}}"/>

        @endforeach

        </div>
        @endif

        @foreach($articles as $article)
        <li><i><a href="{{url('article/detail/'.$article['id'])}}"><img src="{{$article['img_url']}}"></a></i>
            <h3><a href="{{url('article/detail/'.$article['id'])}}">{{$article['title']}}</a></h3>
            <p>{{$article['desc']}}</p>
        </li>

            @endforeach


    </main>

    {{--分页操作--}}
   <div style="margin-left: 60%"> {{$articles->links()}} </div>

</article>

    <script type="text/javascript">

         /*jump函数，点击时跳转，跳转地址为图片跳转地址url*/
        /*function jump(url) {
           location.href=url;
        }*/
    </script>


@endsection