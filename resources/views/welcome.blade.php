<!DOCTYPE html>
<html>
    <head>
        <title>VUI GIÁNG SINH - RINH QUÀ KHỦNG</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="{{asset('images/shortcut-icon.png')}}" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
                background-image: url(../../../images/background3.jpg);
                background-size: cover;
                font-family: 'Coiny', cursive;
                
            }
            @media screen and (max-width: 576px) {
                body {
                    background-image: url(../../../images/background-mobile.jpg);
                    background-size: cover;
                }
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
            .login button {
                font-size: 30px;
            }
            .logout a {
                font-family: 'Roboto', sans-serif;
                color: #0996fd;
            }
            .logout {
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="login">
                    <a href="/login"><button type="button" class="btn btn-primary">ĐĂNG NHẬP</button></a>

                </div>
                <div class="logout">
                    <a href="/logout">đăng xuất</a>
                </div>
            </div>
        </div>
    </body>
</html>
