<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{ __("welcome") }}
<a href="{{ locale_url('fr') }}">Français</a>
<a href="{{ locale_url('en') }}">English</a>

</body>
</html>