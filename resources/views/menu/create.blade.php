@extends('layout.default')

@section('contents')
    @include('layout._errors')
    @include('vendor.ueditor.assets')

    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>

    <!-- 编辑器容器 -->
    <script id="container" name="content" type="text/plain"></script>
    <form action="{{route('menu.store')}}" method="post" enctype="multipart/form-data" style="width: 400px">
        <div class="form-group">
            <label>菜品名称:</label>
            <input type="text" class="form-control" name="goods_name" value="{{old('goods_name')}}" placeholder="请输入菜品名称">
        </div>
        <div class="form-group">
            {{--<label>所属商家</label>--}}
            <input type="hidden"  class="form-control" value="{{auth()->user()->shop_id}}" name="shop_id">
        </div>
        <div class="form-group">
            <label>菜品分类:</label>
            <select name="category_id" id="" class="form-control">
                @foreach($menucategorys as $menucategory)
                <option value="{{$menucategory->id}}">{{$menucategory->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>价格:</label>
            <input type="text" class="form-control" name="goods_price" value="{{old('goods_price')}}" placeholder="请输入菜品的价格">
        </div>
        <div class="form-group">
            <label>描述:</label>
            <input type="text" class="form-control" name="description" value="{{old('description')}}" placeholder="请输入菜品描述">
        </div>
        <div class="form-group">
            <label>提示信息:</label>
            <input type="text" class="form-control" name="tips" value="{{old('tips')}}">
        </div>
            <div class="form-group">
                <label>状态:</label>
                <input type="text" class="form-control" name="status" value="{{old('tips')}}">
            </div>
        <!--dom结构部分-->
        <div class="form-group">
            <label>分类图片</label>
            <input type="text" name="goods_img" id="goods_img">
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
            <img id="pic" src="{{old('goods_img')}}" width="50px"/>
        </div>
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary"> 确认添加</button>
    </form>
@endsection
@section('javascript')
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            //swf: BASE_URL + '/js/Uploader.swf',
            // 文件接收服务端。
            server: '{{ route('upload') }}',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData:{
                _token:"{{ csrf_token() }}"
            }
        });
        uploader.on( 'uploadSuccess', function( file,response ) {
            //$( '#'+file.id ).addClass('upload-state-done');
            //console.log(response.path);图片地址
            //将上传成功的图片显示
            $("#pic").attr('src',response.path);
            //将图片地址写入输入框
            $("#goods_img").val(response.path);
        });
    </script>
@stop