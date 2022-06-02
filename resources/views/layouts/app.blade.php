<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">
    @include('layouts.nav')
    <div id="app" class="wrapper">        
        @include('layouts.side')        
        @yield('content')
        <router-view></router-view>
        <eventhub-component></eventhub-component>
    </div>
    @include('layouts.script')
</body>

</html>