<!DOCTYPE html>
<!-- utilizando o helper config para buscar o idioma do site -->
<html lang="{{ config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name')}}</title>
</head>
<body>
    <div class="content">
        <!-- diretiva yield para montar a estrutura do site -->
        @yield('content')
    </div>
</body>
</html>
