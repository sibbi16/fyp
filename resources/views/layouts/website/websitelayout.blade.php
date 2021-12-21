<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/images/logo.png">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    {{$style ?? ""}}
    <title>Sourcers</title>

</head>

<body>
    @include('layouts.website.partials.header')
    {{ $slot }}
    @include('layouts.website.partials.footer')
    {{$script ?? ""}}
</body>

</html>
