<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
        <title>Laravel</title>

    </head>
    <body>
        <div id="app">
            <index-vue/>
        </div>
    </body>
    <script src="{{ asset('js/app.js') }}" defer></script>
</html>
