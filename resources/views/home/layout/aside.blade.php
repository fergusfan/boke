
    <aside class="l_box">

        <div class="search">
            <form action="{{url('article/search')}}" method="post" name="searchform" id="searchform">
                {{csrf_field()}}

                <input name="keywords" id="keyboard" class="input_text" value="请输入关键字词"
                       style="color: rgb(153, 153, 153);" onfocus="if(value=='请输入关键字词')
                       {this.style.color='#000';value=''}" onblur="if(value=='')
                       {this.style.color='#999';value='请输入关键字词'}" type="text">

                <input  class="input_submit" value="搜索" type="submit">
            </form>
        </div>

        <div class="about_me">
            <h2>关于作者</h2>
            <ul>
                <i><img src="{{asset('/home/images/tx.jpg')}}"></i>
                <p>{!!$sys['edithor']!!}</p>
            </ul>
        </div>


        <div class="tuijian">
            <h2>最近发布</h2>
            <ul>

                @foreach($newArts as $newArt)
                <li><a href="{{url('article/detail/'.$newArt['id'])}}">{{$newArt['title']}}</a></li>

                @endforeach

            </ul>
        </div>

        <div class="guanzhu">
            <h2>求打赏啊</h2>
            <ul>
                <img src="{{asset('/home/images/zfb.jpg')}}">
            </ul>
        </div>

        <div class="cloud">
            <h2>文章标签</h2>
            <ul>

                @foreach($keywords as $key)
                <li><a href="javascript:;">{{$key}}</a> </li>
                @endforeach


            </ul>
        </div>

        @if(!empty($links))
        <div class="links">
            <h2>友情链接</h2>
            <ul>

                @foreach($links as $link)
                <li><a href="{{$link['url']}}">{{$link['title']}}</a> </li>
                @endforeach

            </ul>
        </div>
        @endif

    </aside>
