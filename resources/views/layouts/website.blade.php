<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/images/logo.png">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Sourcers</title>
    
    {{$style ?? ""}}

</head>

<body>
    @include('layouts.partials.website.header')
    {{ $slot }}
    @include('layouts.partials.website.footer')
    {{$script ?? ""}}
</body>

</html>
