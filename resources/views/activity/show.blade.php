@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <div class="form-group">
        <label for="">活动名称:</label>
        {{$activity->title}}
    </div>
    <div class="form-group">

        <label for="">活动开始时间:</label>
        {{$activity->start_time}}
        <label for="">活动开始时间:</label>
        {{ $activity->end_time }}
    </div>

    <div class="form-group">
        <label for="">活动详情:</label>
        {!! $activity->content !!}
    </div>
@endsection
