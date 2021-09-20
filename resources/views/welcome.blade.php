<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/vue2-org-tree/dist/style.css">
        <title>Laravel</title>

    </head>
    <body class="antialiased">
        <div id="app">
            <example-component></example-component>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
