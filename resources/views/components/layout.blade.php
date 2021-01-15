<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>{{ $title ?? 'Ebay Search' }}</title>
</head>
<body>
    <h1>Ebay Search</h1>

    {{ $slot }}
</body>
</html>
