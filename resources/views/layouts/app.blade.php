<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')

<body>
    @include('layouts.nav')
    <div id="app" class="row pt-2" style="margin: auto;">       
        @if(Auth::check())
        @include('layouts.side')
        @endif
        @yield('content')
        <router-view></router-view>
        <eventhub-component></eventhub-component>
    </div>
    </div>
    @include('layouts.script')
</body>

</html>