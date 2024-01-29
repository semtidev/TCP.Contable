<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <style>
            @page { margin: 40px 25px; font-size: 12px; }
            .entrydata { font-size: 12px; padding: 3px 5px; }
        </style>

    </head>
    <body>
        <main style="width:100%">
            @yield('content')
        </main>        
    </body>
</html>