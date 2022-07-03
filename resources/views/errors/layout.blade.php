<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #ffffff;
                color: #636b6f;
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
               
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                /* height: 100vh; */
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
               
                font-size: 36px;
                /* padding: 20px; */
                position: absolute;
                
            }

            .container-fluid{
            
                position: relative;
            }


        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="container-fluid">
                <div class="title">
                    @yield('message')
                    
                </div>
                @yield('image')
            </div>
        </div>
    </body>
</html>
