<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TodoList Platform</title>

    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/style.css') !!}
</head>
<body>
    @include('inc.navbar')

    <div class="container">
        @yield('content')
    </div>
<div>
    @include('inc.footer')
</div>
{!! Html::script('js/jquery.min.js') !!}
{!! Html::script('js/bootstrap.min.js') !!}
{!! Html::script('js/script.js') !!}
</body>
</html>