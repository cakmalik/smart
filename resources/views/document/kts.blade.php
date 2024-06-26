<html>

<head>
    <style>
        #left-panel {
            height: auto;
            width: 25%;
            float: left;
            /* border: 1px solid salmon; */
        }

        #right-panel {
            float: right;
            width: 71%;
            /* border: 1px solid salmon; */
            height: auto;
            padding-top: 200px;

        }

        #fotosiswa {
            margin-top: 550px;
            margin-left: 200px;
            /* border: 1px solid salmon; */
            width: 500px;
            height: 700px;
        }

        #tgl-panel {
            float: right;
            width: 31%;
            /* border: 1px solid salmon; */
            height: auto;
        }

        img {
            width: 250px;
        }


        table {
            /* vertical-align: top; */
            font-family: 'gotik';
            text-transform: capitalize;
            font-size: 76px;
            /* font-size: 400%; */
            padding-top: 550px;
            padding-left: 110px;
            padding-bottom: 4px;
            padding-right: 40px;
            line-height: 140%;
        }

        td,
        th {
            text-align: left;
        }

        p {
            text-transform: capitalize;
        }

        img.barcode {
            padding-top: 380px;
            height: 400px;
            width: 700px;
        }

        p {
            margin: 0;
            padding: 0;
        }

        p.nis {
            /* font-weight: bold; */
            font-size: 100px;
            text-align: left;
            padding-left: -14px;
            padding-top: 350px;
            font-family: Arial, Helvetica, sans-serif;
        }

        p.nama {
            font-weight: bold;
            font-size: 100px;
            text-align: left;
            padding-left: -14px;
            padding-top: 30px;
            font-family: Arial, Helvetica, sans-serif;
        }

        p.ttl {
            font-size: 100px;
            text-align: left;
            padding-left: -14px;
            padding-top: 30px;
            font-family: Arial, Helvetica, sans-serif;
            /* padding-top: 350px; */
        }

        p.tgl {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 50px;
            margin-top: 100px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"
        integrity="sha512-s/XK4vYVXTGeUSv4bRPOuxSDmDlTedEpMEcAQk0t/FMd9V6ft8iXdwSBxV0eD60c6w/tjotSlKu9J2AAW1ckTA=="
        crossorigin="anonymous"></script>
</head>

<body>
    <input id="btn-Preview-Image" type="button" value="Preview" />
    <a id="btn-Convert-Html2Image" href="#">Download</a>
    <br />
    <br>

    {{-- DISINI KONTENNYA --}}
    <div id="html-content-holder"
        style="background-image:url('{{ url('assets/img/kts-depan.png') }}'); width: 3000px;height: 1893px;">
        <div id="left-panel">
            <img src="{{ asset('storage/student-photos/example.jpg') }}" id="fotosiswa">
        </div>

        <div id="right-panel">
            <p class="nis">{{ $student->nis . ' / ' . $student->nisn }}</p>
            <p class="nama">{{ $student->name }}</p>
            <p class="ttl">{{ $student->name }}</p>
            <p class="ttl" style="text-transform: uppercase;">
                {{ $student->village . ' - ' . $student->disrict . ' - ' . $student->city }}</p>
        </div>
        <div id="tgl-panel">
            <p class="tgl">Lumajang, {{ $student->name }}</p>
        </div>

    </div>

    <h3>Preview :</h3>
    <div id="previewImage">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {


            var element = $("#html-content-holder"); // global variable
            var getCanvas; // global variable

            $("#btn-Preview-Image").on('click', function() {
                html2canvas(element, {
                    onrendered: function(canvas) {
                        $("#previewImage").append(canvas);
                        getCanvas = canvas;
                    }
                });
            });

            $("#btn-Convert-Html2Image").on('click', function() {
                var imgageData = getCanvas.toDataURL("image/png");
                // Now browser starts downloading it instead of just showing it
                var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                $("#btn-Convert-Html2Image").attr("download", "kts.png").attr("href", newData);
            });

        });
    </script>
</body>

</html>
