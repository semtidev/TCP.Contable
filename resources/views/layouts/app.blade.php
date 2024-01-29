<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TCP.Contable</title>
    <link rel="shortcut icon" href="{{ asset('images/icons/user.png') }}" />

    <!-- Styles -->
    <link href="{{ asset('extjs42/resources/css/ext-all-neptune.css') }}" rel="stylesheet">
	<link href="{{ asset('fa-563/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="topnav" class="x-hide-display">
        <div class="appname"><h1>TCP.Contable</h1></div>
        <div class="apphome"><a id="homeBtn" style="cursor: pointer"><i class="fas fa-home"></i> Inicio</a></div>
        <div class="applogout"><a id="logoutBtn" style="cursor: pointer" title="Cerrar Sesi&oacute;n en TCP.Contable"><i class="fas fa-sign-out-alt"></i> Salir</a></div>
        <div id="tcpselector" class="tcpselector"></div>
    </div>
</body>

<!-- Scripts -->
<script src="{{ asset('extjs42/ext-all.js') }}"></script>
<script src="{{ asset('extjs42/locale/ext-lang-es.js') }}"></script>
<script src="{{ asset('extjs42/ext-theme-neptune.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
</html>
