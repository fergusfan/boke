@extends('admin.layout.layout')
@section('content')
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
  <div class="body-content">
    <form method="post" id="form" class="form-x" action="{{url('admin/article')}}">
        {{csrf_field()}}
      <div class="form-group">
        <div class="label">
          <label>文章标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="title" datatype="s5-30"/>
          <div class="tips"></div>
        </div>
      </div>

      <div class="clear"></div>
      <div class="form-group">
        <div class="label">
          <label>关键字标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="keywords" value=""datatype="s2-10"/>
        </div>
      </div>

      <div class="form-group">
        <div class="label">
          <label>作者：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="author" value=""  datatype="s2-10"/>
          <div class="tips"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="label">
          <label>图片：</label>
        </div>
        <div class="field">
        {{--<input type="text" id="url1" name="img" class="input tips" style="width:25%; float:left;"  value="" data-toggle="hover"
               data-place="right" data-image="" />
        <input type="button" class="button bg-blue margin-left" id="image1" value="+ 浏览上传"  style="float:left;">
        --}}
        <!--dom结构部分-->
          <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
            <div class="tipss">图片尺寸：1024*1024*2</div>
          </div>
        </div>
      </div>


        <div class="form-group">
          <div class="label">
            <label>分类标题：</label>
          </div>
          <div class="field">
            <select name="cat_id" class="input w50">
              <option value="">请选择分类</option>
              @foreach($cats as $cat)
              <option value="{{$cat['id']}}">{{$cat['cat_name']}}</option>
              @endforeach
            </select>
            <div class="tips"></div>
          </div>
        </div>


        {{--<div class="form-group">
          <div class="label">
            <label>其他属性：</label>
          </div>
          <div class="field" style="padding-top:8px;"> 
            首页 <input id="ishome"  type="checkbox" />
            推荐 <input id="isvouch"  type="checkbox" />
            置顶 <input id="istop"  type="checkbox" /> 
         
          </div>
        </div>--}}


      <div class="form-group" >
        <div class="label">
          <label>描述：</label>
        </div>
        <div class="field">
          <textarea class="input" name="desc" datatype="s10-200" style=" height:90px;"></textarea>
          <div class="tips"></div>
        </div>
      </div>


      <div class="form-group"style="display: none">
        <div class="label">
          <label>内容：</label>
        </div>
        <div class="field">
          <textarea name="content" id="text" class="input" style="height:450px; border:1px solid #ddd;"></textarea>
          <div class="tips"></div>
        </div>
      </div>

        <div class="form-group" >
            <div class="label">
                <label>内容：</label>
            </div>


      <div style="margin-left: 130px;width: 85%" id="editor">
        <p> </p>
      </div>
      <br><br>

      {{--<div class="form-group">
        <div class="label">
          <label>内容关键字：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="s_keywords" value=""/>
        </div>
      </div>--}}


     {{-- <div class="form-group">
        <div class="label">
          <label>关键字描述：</label>
        </div>
        <div class="field">
          <textarea type="text" class="input" name="s_desc" style="height:80px;"></textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="label">
          <label>排序：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="sort" value="0"  data-validate="number:排序必须为数字" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>发布时间：</label>
        </div>
        <div class="field"> 
          <script src="js/laydate/laydate.js"></script>
          <input type="text" class="laydate-icon input w50" name="datetime" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value=""  data-validate="required:日期不能为空" style="padding:10px!important; height:auto!important;border:1px solid #ddd!important;" />
          <div class="tips"></div>
        </div>
      </div>--}}



      {{--<div class="form-group">
        <div class="label">
          <label>点击次数：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="views" value="" data-validate="member:只能为数字"  />
          <div class="tips"></div>
        </div>
      </div>--}}

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

<script type="text/javascript">
    // 初始化Web Uploader
    var uploader = WebUploader.create({

        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        swf: "{{ asset('/lib/webuploader-0.1.5/Uploader.swf')}}",

        // 文件接收服务端。
        server: "{{url('admin/upload')}}",

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',
        //文件大小限制
        fileSingleSizeLimit: 1024*1024*2,

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file,res )
    {
        //图片预览
        //在页面指定位置将图片显示出来
        $('#uploader-demo').append('<img  style="position: absolute;margin-left:200px;margin-top:-50px;width: 200px;height: 100px" src=/'+ res.url +'>');
        //添加一个隐藏的input标签，包含图片地址
        $('#uploader-demo').append('<input type="hidden" name="img_url" value='+ res.url +'>');

        //console.log(res.url);
        //$( '#'+file.id ).addClass('upload-state-done');
    });

    var E = window.wangEditor
    var editor = new E('#editor')
    // 或者 var editor = new E( document.getElementById('editor') )

    // 配置服务器端地址  实现编辑器可以上传图片
    editor.customConfig.uploadImgServer = "{{url('admin/article/upload')}}";
    //自定义上传文件名filename,对应于ArticleController中获取上传图片名
    editor.customConfig.uploadFileName = 'file'
    //获取富文本编辑器中html内容
    editor.customConfig.onchange = function (html) {
        // 监控变化，将富文本编辑中html值同步更新到内容的 textarea中
        $('#text').val(html)
    }

    editor.create()

    $('#form').Validform({
        tiptype:4,
        ajaxPost:true,
        callback:function(res){
            if(res.status=='success'){
                window.parent.location.href="{{url('admin/index')}}";
            }else{
                layer.msg(res.msg,{icon:2});
            }
        }

    });

    </script>

@endsection