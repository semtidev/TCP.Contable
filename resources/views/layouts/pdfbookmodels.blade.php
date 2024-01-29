<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <style>
            @page { margin: 90px 25px 0 25px; }
            h2 { font-size: 22px; text-transform: uppercase; line-height: 20px; margin: 0; padding: 20px; }
            h4 { font-size: 16px; text-transform: uppercase; line-height: 18px; margin: 0; padding: 10px; font-weight: 500; }
            h5 { font-size: 15px; text-transform: none; line-height: 15px; margin: 0; padding: 10px; font-weight: 500; }
            header { position: fixed; top: -80px; left: 0px; right: 0px; padding: 10px 15px; height: 20px; vertical-align: middle; margin-bottom: 0px !important; }
            .header-page { width: 100%; text-align: center; margin: 0; padding: 0;}
            p { page-break-after: always; }
            p:last-child { page-break-after: never; }
            .pagenum:before {
                content: counter(page);
            }
            hr { margin: 50px auto; border-color: #ccc; }
            .page-break {
                page-break-after: always;
            }
            .cover { width: 100%; margin-top: 200px; }
            .cover .logo { width: 100%; margin-bottom: 150px; text-align: center; }
            .cover .system { 
                width: 100%; 
                margin-bottom: 100px; 
                text-align: center; 
                text-transform: uppercase;
                font-size: 18px;  
            }
            .cover .reportname { 
                width: 100%; 
                text-align: center; 
                text-transform: uppercase;
                font-size: 30px; 
                line-height: 50px; 
            }
            .cover .year { 
                width: 100%; 
                text-align: center;
                margin-top: 100px;
                text-transform: uppercase;
                font-size: 16px; 
                line-height: 30px; 
            }
            .table_rules { border: #333 1px solid; margin: 0 auto; width: 95%; }
            .table_rules .title { text-align: center; padding: 10px 20px; text-transform: uppercase; font-weight: 700; font-size: 15px; }
            .table_rules .content { padding: 20px; text-align: justify; }
            .table_tcp { border: #333 1px solid; margin: 0 auto; width: 95%; }
            ul { padding-left: 25px; }
            .table_help { border: #333 1px solid; margin: -30px auto 0 auto; width: 95%; }
            .table_help .title { text-align: center; padding: 10px 20px; text-transform: uppercase; font-weight: 700; font-size: 15px; }
            .table_help .content { padding: 20px; text-align: justify; }
            .table_help ul li { list-style: none; }
            .monthreport { padding: 5px 10px; text-transform: uppercase; }
            .monthreportitle { text-align: center; padding: 5px 20px; text-transform: uppercase; }
            .tablesubtitle { text-align: center; padding: 5px 10px; text-transform: uppercase; font-size: 12px; font-weight: 700; }
            .help { text-align: center; font-size: 12px; }
            .entrydata { font-size: 14px; padding: 3px 10px; }
            .cell-mark { 
                background: url(/images/pdf-water-mark.jpg) repeat;
            }
        </style>

    </head>
    <body>
        <main style="width:100%">
            @yield('content')
        </main>        
    </body>
</html>