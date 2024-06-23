<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/@phosphor-icons/web@2.0.3"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Playwrite+ID:wght@100..400&display=swap');    </style>
    <style>
        .ph-fill {
            font-size: 27px;
        }
    </style>
    @spladeHead
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body class="font-sans antialiased" style="margin-bottom: 0px">
    @splade

    <x-splade-script>
        initFlowbite();
       
    </x-splade-script>
    
</body>

</html>
