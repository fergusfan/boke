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


      @if(!empty($articles))
          @foreach($articles as $article)
              <li><i><a href="{{url('article/detail/'.$article['id'])}}"><img src="/{{$article['img_url']}}"></a></i>
                  <h3><a href="{{url('article/detail/'.$article['id'])}}">{{$article['title']}}</a></h3>
                  <p>{{$article['desc']}}</p>
              </li>

          @endforeach
      @else

          没有你要搜索的关键词
      @endif

   {{-- <div class="pagelist">{{$articles->links()}} </div>--}}


  </main>
</article>


    @endsection