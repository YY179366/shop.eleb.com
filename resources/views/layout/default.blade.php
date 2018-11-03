@include('layout._head')

@include('layout._nav')

<div class="container">
    @include('layout._notice')
    @yield('contents')
    @yield('javascript')
</div>

</body>
@include('layout._foot')
