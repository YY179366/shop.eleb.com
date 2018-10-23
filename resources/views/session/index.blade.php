@extends('layout.default')

@section('contents')
    @include('layout._errors')

    <h1>商家登录页面</h1>

        <form action="{{route('login')}}" style="width: 500px" method="post">
            <div class="form-group">
                <label for="">用户名</label>
                <input type="text" class="form-control" placeholder="请输入用户名" name="name" >
            </div>
            <div class="form-group">
                <label for="">密码</label>
                <input type="password" class="form-control" placeholder="请输入密码" name="password">
            </div>
            <div class="form-group">
                <label for="">验证码</label>
                <input type="text" class="form-control" placeholder="请输入验证码" name="captcha">
                <img class="thumbnail captcha" src="{{ captcha_src('flat') }}"
                     onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" value="1"> 记住我
                </label>
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-info btn-block">立即登录</button>
        </form>
@endsection
