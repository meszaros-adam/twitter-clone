<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter Clone</title>
    @vite('resources/css/style.css')
    <script src="https://kit.fontawesome.com/87803efb4c.js" crossorigin="anonymous"></script>
</head>

<body>

    <div id="app">
        @if(Auth::check())
        <app :user="{{Auth::user()}}"></app>
        @else
        <app :user="false"></app>
        @endif
    </div>
    @vite('resources/js/app.js')
    </div>
</body>

</html>