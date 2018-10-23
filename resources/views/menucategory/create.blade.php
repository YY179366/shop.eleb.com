@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form action="{{route('menucategory.store')}}" method="post" enctype="multipart/form-data" style="width: 300px">
        <div class="form-group">
            <label>分类名:</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            {{--<label>所属商家</label>--}}
            <input type="hidden"  class="form-control" value="{{auth()->user()->shop_id}}" name="shop_id">
        </div>
        <div class="form-group">
            <label>描述:</label>
            <input type="text" class="form-control" name="description" value="{{old('description')}}">
        </div>

        <div class="form-group">
            <label>是否为默认分类:</label>
            <label><input type="radio" name="is_selected" value="1">是</label>&emsp;
            <label><input type="radio" name="is_selected" checked value="0">否</label>
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary"> 确认添加</button>
@endsection
