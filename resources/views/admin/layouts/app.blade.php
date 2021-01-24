<!DOCTYPE html>
<!-- utilizando o helper config para buscar o idioma do site -->
<html lang="{{ config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name')}}</title>

    <link rel="stylesheet" href="{{url('css/app.css')}}">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto py-8">
        <!-- diretiva yield para montar a estrutura do site -->
        @yield('content')
    </div>
</body>
</html>
