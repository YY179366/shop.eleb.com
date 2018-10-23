@extends('layout.default')

@section('contents')
    @include('layout._errors')
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
            <div class="form-group">
                <label>分类图片</label>
                <input type="file" name="goods_img" >
            </div>

        {{csrf_field()}}
        <button type="submit" class="btn btn-primary"> 确认添加</button>
    </form>
@endsection