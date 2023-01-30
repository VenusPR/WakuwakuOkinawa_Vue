<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cork - Vuejs, HTML & Laravel Admin Dashboard Template</title>

    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
</head>

<body>
    <noscript>
        <strong>We're sorry but Cork doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
    </noscript>

    <div id="app"></div>

    <script src="{{ asset(mix('js/main.js')) }}"></script>
</body>
</html>
