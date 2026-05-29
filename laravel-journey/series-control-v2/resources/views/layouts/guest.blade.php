<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="text-center mb-4">
                    <a href="/">
                        <x-application-logo style="width: 60px; height: 60px;" />
                    </a>
                </div>
                <div class="card p-4 shadow-sm">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
