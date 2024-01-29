<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <style>
            @page { margin: 90px 25px 30px 25px; }
            h2 { font-size: 20px; text-transform: uppercase; line-height: 20px; margin: 0; padding: 20px; }
            h3 { font-size: 18px; text-transform: uppercase; line-height: 18px; margin: 0; padding: 8px; }
            h4 { font-size: 16px; text-transform: uppercase; line-height: 18px; margin: 0; padding: 7px; font-weight: 500; }
            h5 { font-size: 15px; text-transform: none; line-height: 15px; margin: 0; padding: 7px; font-weight: 500; }
            header { position: fixed; top: -80px; left: 0px; right: 0px; padding: 10px 15px; height: 20px; vertical-align: middle; margin-bottom: 0px !important;}
            .header-page { width: 100%; text-align: center; margin: 0; padding: 0;}
            .mt-0 { margin-top: -20px !important; }
            p { page-break-after: always; }
            p:last-child { page-break-after: never; }
            br {
                margin: 10px 0;
            }
            .pagenum:before {
                content: counter(page);
            }
            .page-break {
                page-break-after: always;
            }
            .cover { width: 100%; margin-top: 80px; }
            .cover .logo { width: 100%; margin-bottom: 130px; text-align: center; }
            .cover .system { 
                width: 100%; 
                margin-bottom: 80px; 
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
                margin-top: 50px;
                text-transform: uppercase;
                font-size: 18px; 
                line-height: 30px; 
            }
            .table_rules { border: #333 1px solid; margin: 50px auto; width: 100%; }
            .table_rules .title { text-align: center; padding: 10px 20px; text-transform: uppercase; font-weight: 700; font-size: 15px; }
            .table_rules .content { padding: 20px; text-align: justify; }
            .table_help, .table_help3 { border: #333 1px solid; margin: -40px auto 0 auto; width: 100%; }
            .table_help2 { border: #333 1px solid; margin: 20px auto 0 auto; width: 100%; }
            .table_help .title, .table_help2 .title, .table_help3 .title { text-align: center; padding: 5px 20px; text-transform: uppercase; font-weight: 700; font-size: 15px; }
            .table_help2 .title2 { text-align: center; padding: 5px 2px; text-transform: uppercase; font-weight: 700; font-size: 14px; }
            .table_help .content { padding: 15px; text-align: justify; font-size: 15px; }
            .table_help2 .content, .table_help3 .content { padding: 5px 15px; text-align: justify; font-size: 14px; }
            .table_help .content ul, .table_help3 .content ul { padding-bottom: 0; margin-bottom: 0; }
            .table_help .content ul { padding: 0 0 0 25px; margin: 0; }
            .table_help3 .content ul { padding: 0; margin: 0; }
            .table_help .content li, .table_help3 .content li { list-style: none; }
            .help-title { width: 350px; border-bottom: #000 1px solid; font-weight: 700; padding: 0; margin: 0; }
            .table_tcp { border: #333 1px solid; margin: 0 auto; width: 95%; }
            .table-page { margin-top: -30px; }
            .monthreport { padding: 2px 10px; text-transform: uppercase; font-size: 14px; }
            .monthreportitle { text-align: center; padding: 2px 20px; text-transform: uppercase; font-size: 14px; }
            .tablesubtitle { text-align: center; padding: 5px 10px; text-transform: uppercase; font-size: 12px; font-weight: 700; }
            .help { text-align: center; font-size: 12px; }
            .data { font-size: 12px; padding: 5px 10px; }
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