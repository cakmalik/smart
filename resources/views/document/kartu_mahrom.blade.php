<html>

<head>
    <style>
        @font-face {
            font-family: 'MyriadPro';
            src: url('/fonts/myriadpro-regular.otf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        /* Contoh penggunaan font di elemen tertentu */
        body {
            font-family: 'MyriadPro', sans-serif;
        }

        #left-panel {
            height: auto;
            width: 65%;
            float: left;
        }

        #right-panel {
            float: right;
            width: 27%;
            /* border: 1px solid salmon; */
            height: auto;
            padding-top: 200px;

        }

        .block {
            display: block;
            width: 100%;
            border: none;
            background-color: #04AA6D;
            padding: 14px 28px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }

        img {
            width: 200px;
            margin-bottom: 20px
        }

        table {
            font-family: 'gotik';
            text-transform: capitalize;
            font-size: 60px;
            /* font-size: 400%; */
            padding-top: 650px;
            padding-left: 226px;
            padding-bottom: 4px;
            padding-right: 40px;
            line-height: 100%;
        }

        td,
        th {
            text-align: left;
        }

        p {
            font-family: 'gotik';
            text-transform: capitalize;
        }

        p.tgl {
            position: static;
            padding-left: 225px;
            padding-top: 70px;
            bottom: 125px;
            z-index: 1;
            font-size: 240%;

        }

        img.default_img {
            background-position-x: center;
            margin-top: 450px;
            border-radius: 40%;
            width: 600px;
            height: 800px;
        }

        img.barcode {
            padding-top: 40px;
            height: 200px;
            width: 600px;
        }

        strong.percantikspasi {
            color: white;
        }
    </style>

    <script src="{{ asset('bakid/kartu/jquery.min.js') }}"></script>
    <script src="{{ asset('bakid/kartu/html2canvas.js') }}"></script>
</head>

<body>
    {{-- <input id="btn-Preview-Image" type="button" value="Preview" /> --}}
    <a id="btn-Convert-Html2Image" href="#" class="block">Download</a>
    <br />
    <br>

    <div id="html-content-holder"
        style="background-image:url('{{ asset('bakid/kartu/kt-mahrom.png') }}'); width: 3000px;height: 1893px;">

        <div id="left-panel">

            <table>
                {{-- <tr>
                    <th valign="top" width="480px"><strong> NO INDUK</strong></th>
                    <th valign="top"><strong> &nbsp;: &nbsp; </strong></th>
                    <th valign="top"><strong> <?= strtoupper($student->nis) ?></strong>
                        <strong class="percantikspasi"> --------------------------------------------------------</strong></th>
                </tr>
                <tr>
                    <th valign="top">Nama</th>
                    <th valign="top"><strong> &nbsp;: &nbsp; </strong></th>
                    <th valign="top"> <strong> <?= strtoupper($student->nama) ?></strong></th>
                </tr>
                <tr>
                    <th valign="top">Asrama</th>
                    <th valign="top"><strong> &nbsp;: &nbsp; </strong></th>
                    <th valign="top"> <strong> <?= strtoupper($student->daerah) ?></strong></th>
                </tr>
                <tr>
                    <th valign="top">Orang Tua/Wali</th>
                    <th valign="top"><strong> &nbsp;: &nbsp; </strong></th>
                    <th valign="top"> <strong> <?= strtoupper($student->ayah) ?></strong></th>
                </tr>
                <tr>
                    <th valign="top">Alamat</th>
                    <th valign="top"><strong> &nbsp;: &nbsp; </strong></th>
                    <th valign="top"> <strong> <?= strtoupper($student->desa . ', ' . $student->kec . ', ' . $snt->kab) ?></strong></th>
                </tr> --}}
            </table>

            <p class='tgl'><b>Lumajang, <?= date('d M Y') ?></b> </p>


        </div>
        <div id="right-panel">

        </div>
    </div>

    <h3>Preview :</h3>
    <div id="previewImage">
    </div>
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
                $("#btn-Convert-Html2Image").attr("download", "")
                    .attr("href", newData);
            });

        });
    </script>
</body>

</html>
