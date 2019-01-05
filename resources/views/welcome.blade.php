<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

    <body>
    welcome page
    <div id="app">
        <p>
            <router-link :to="{ name: 'laracast' }">Home</router-link> |
            <router-link to="/hello">Hello World</router-link>
        </p>

        <router-view></router-view>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    </body>

</html>
