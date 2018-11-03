<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('menu.create')}}">添加菜品</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('menu.index')}}">菜品列表</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品分类 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('menucategory.create')}}">添加菜品分类</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('menucategory.index')}}">菜品分类列表</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">活动页面 <span class="caret"></span></a>
                    <ul class="dropdown-menu">

                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('activity.index')}}">活动列表</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">抽奖<span class="caret"></span></a>
                    <ul class="dropdown-menu">

                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('activity.index')}}">抽奖</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">会员管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">

                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('member.index')}}">会员列表</a></li>
                        <li><a href="{{route('member.create')}}">添加会员</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{ route('login') }}">登录</a></li>
                <li><a href="{{ route('shop.create') }}">注册</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span>{{ auth()->user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"></a></li>
                        <li><a href="{{ route('session.change') }}">修改密码</a></li>
                        <li role="separator" class="divider"></li>
                        <form action="{{route('logout')}}" method="post">
                            {{csrf_field()}}{{method_field('DELETE')}}
                            <button class="btn btn-link">注销</button>
                        </form>
                    </ul>
                </li>
                    @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>