<style>

   #full, html {
        font-family: 'Tahoma', sans-serif;
        box-sizing: border-box;
        color: #1A1B1B;
        background-color: #eee;
    }

    #header {
        width: 100%;
        height: 120px;
        background: #1a1b1b;
        display: block;
        float: left;
        padding:10px;
    }

    .h3 {
        font-size: 24px;
        font-weight: 700;
        line-height: 30px;
        display: block;
        width: 100%;
        margin: 20px 0;
    }

    .p {
        font-size: 16px;
        line-height: 26px;
        color: #424444;
        margin:5px 3px;
    }

    #content {
        width: 100%;
        float: left;
        background:#fff;
        padding:10px;
    }

    #footer {
        padding: 10px;
        border-top: 1px solid #1A1B1B;
        float: left;
        width: 100%;
        background:#fff;
    }

    #footer .p {
        color: #727272;
        font-size: 12px;
        line-height: 20px;
    }

    .btn {
        background: #1a1b1b;
        color: #fff;
        font-size: 16px;
        line-height: 18.4px;
        text-align: center;
        padding: 15px 35px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 600;
    }
    .table .td, .table .th{
        padding:5px 10px;
        text-align: left;
        color:#1a1b1b;
    }

</style>

<html>
    <body>
        <div id="full" style="background-color:#fff;">
            <div style="width:{{$emailWidth ?? '580px'}}; margin:20px auto;">
                <div id="header">
                    <img class="img-fluid" src="{{'data:image/jpg;base64,'.base64_encode(file_get_contents(public_path().'/img/logo/logo.png'))}}"
                         style="display:block; width:80px; margin:20px auto;">
                </div>

                <div id="content">
                    @yield('content')
                </div>
                <div id="footer">
                    @yield('footer')
                </div>
            </div>
        </div>
    </body>
</html>




