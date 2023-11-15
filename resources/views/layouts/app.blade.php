<!DOCTYPE html>
<html>
<head>
    <title>Notes App</title>
    <!-- Add Bootstrap CSS for basic styling -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
