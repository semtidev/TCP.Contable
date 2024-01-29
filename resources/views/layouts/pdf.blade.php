<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <style>
            @page { margin: 100px 25px 90px 25px; }
            header { position: fixed; top: -50px; left: 0px; right: 0px; border-bottom: #999 1px solid; padding: 10px 15px; height: 20px; vertical-align: middle; margin-bottom: -20px !important; }
            footer { position: fixed; bottom: -80px; left: 0px; right: 0px; border-top: #999 1px solid; padding: 10px 15px; height: 20px; vertical-align: middle; }
            p { page-break-after: always; }
            p:last-child { page-break-after: never; }
            .pagenum:before {
                content: counter(page);
            }
            .page-break {
                page-break-after: always;
            }
        </style>

    </head>
    <body>
        <header>
            <div style="float:left; width:auto; margin-top:-40px;">
                <img id="logo" src="{{ public_path('images/onat.jpg') }}" style="margin-top:5px;"/>
            </div>
            <div style="float: right; margin-top:-15px; padding-top: 3px; text-align:right"><font style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;">{{ strtoupper($company) }}<br>TCP: {{ $tcp_name }}</font></div>
        </header>
        <footer>
            <div style="width: 100%; text-align:center; padding-top: 3px;"><font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif;">P&aacute;gina: <span class="pagenum"></span></font></div>
        </footer>
        <main style="width:100%">
            @yield('content')
        </main>
    </body>
</html>