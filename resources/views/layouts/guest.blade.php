<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('backend.includes.head-content')
</head>

<body>
    <div class="font-sans text-gray-900 antialiased" style="padding: 0px; margin:0px">
        {{ $slot }}
    </div>

    @include('backend.includes.bottom-script-content')
</body>
</html>
