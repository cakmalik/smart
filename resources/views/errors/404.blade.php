<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maaf</title>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css');

        html,
        body {
            height: 100%
        }
    </style>
</head>

<body>
    <div class="h-100 d-flex align-items-center justify-content-center grid">
        <div class="row justify-content-center">
            <img src="{{ asset('dist/img/page/404.png') }}" style="width:50vh" />
            <div class="text-center mt-3">
                <h6 class="text-center text-sm btn btn-primary btn-sm  mt-3" style="cursor: pointer"
                    onclick="history.back()">
                    Kembali</h6>
                <h6 class="text-center text-sm btn btn-primary btn-sm  mt-3" style="cursor: pointer"
                    onclick="window.location.href = '/login'">
                    Login</h6>
            </div>
        </div>
    </div>
</body>

</html>
