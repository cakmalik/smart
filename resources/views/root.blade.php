<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/@phosphor-icons/web@2.0.3"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script> --}}
    
    <style>
        .ph-fill {
            font-size: 27px;
        }
        </style>
    @spladeHead
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="font-sans antialiased">
    @splade
</body>

</html>
