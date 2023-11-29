<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')

    <body>

        <div class="dashboard_container">
            <div class="sidebar">
                @yield('nav')
            </div>
            <div class="dashboard_content">
                @yield('content')
            </div>
        </div>
        @stack('js')
        @stack('input-js')
    </body>

</html>
