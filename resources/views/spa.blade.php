<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vue SPA Demo</title>
</head>
<body>
spa .blade.php
<div id="app">
    <p>
        <router-link :to="{ name: 'home' }">Home</router-link> |
        <router-link to="/hello">Hello World</router-link>
    </p>

    <router-view></router-view>
    {{--<app></app>--}}
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>