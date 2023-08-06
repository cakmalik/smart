<html>

<head>
    <style>
        @font-face {
            font-family: 'gotik';
            src: url('<?= base_url('vendor/tambahanjs/GOTHIC.TTF') ?>');
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

        #right-panel p {
            font-size: 10px
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

    <script src="<?= base_url('vendor/tambahanjs/jquery.min.js') ?>"></script>
    <script src="<?= base_url('vendor/tambahanjs/html2canvas.js') ?>"></script>
</head>

<body>
    <input id="btn-Preview-Image" type="button" value="Preview" />
    <a id="btn-Convert-Html2Image" href="#" class="block">Download</a>
    <br />
    <br>

    <!-- <div id="html-content-holder" style="background-image:url('<?= base_url('assets/img/bg_muhrim.png') ?>'); width: 1011px;height: 638px;"> -->

    <div id="html-content-holder"
        style="background-image:url('<?= base_url('assets/img/bg_muhrim.png') ?>'); width: 3000px;height: 1893px;">

        <div id="left-panel">

            <table>
                <tr>
                    <th valign="top" width="480px"><strong> NO INDUK</strong></th>
                    <th valign="top"><strong> &nbsp;: &nbsp; </strong></th>
                    <th valign="top"><strong> <?= strtoupper($snt->nis) ?></strong>
                        <strong class="percantikspasi"> --------------------------------------------------------</strong>
                    </th>
                </tr>
                <tr>
                    <th valign="top">Nama</th>
                    <th valign="top"><strong> &nbsp;: &nbsp; </strong></th>
                    <th valign="top"> <strong> <?= strtoupper($snt->nama) ?></strong></th>
                </tr>
                <tr>
                    <th valign="top">Asrama</th>
                    <th valign="top"><strong> &nbsp;: &nbsp; </strong></th>
                    <th valign="top"> <strong> <?= strtoupper($snt->daerah) ?></strong></th>
                </tr>
                <tr>
                    <th valign="top">Orang Tua/Wali</th>
                    <th valign="top"><strong> &nbsp;: &nbsp; </strong></th>
                    <th valign="top"> <strong> <?= strtoupper($snt->ayah) ?></strong></th>
                </tr>
                <tr>
                    <th valign="top">Alamat</th>
                    <th valign="top"><strong> &nbsp;: &nbsp; </strong></th>
                    <th valign="top"> <strong>
                            <?= strtoupper($snt->desa . ', ' . $snt->kec . ', ' . $snt->kab) ?></strong></th>
                </tr>
            </table>

            <p class='tgl'><b>Lumajang, <?= date('d M Y') ?></b> </p>


        </div>
        <div id="right-panel">
            <?php if (isset($snt->foto_wali)) : ?>
            <img class="default_img" src="<?= base_url() . $snt->foto_wali ?>">
            <?php else : ?>
            <img class="default_img" src="<?= base_url('assets/img/user.jfif') ?>">
            <?php endif ?><br>
            <img class="barcode" src="<?= base_url('assets/barcode/') . $snt->nis . '.jpg' ?>">
        </div>
    </div>

    <h3>Preview :</h3>
    <div id="previewImage">
    </div>
    <script>
        $(document).ready(function() {


            var element = $("#html-content-holder"); // global variable
            var getCanvas; // global variable

            $("#btn-Convert-Html2Image").on('click', function() {
                html2canvas(element, {
                    onrendered: function(canvas) {
                        $("#previewImage").append(canvas);
                        getCanvas = canvas;
                    }
                });
                var imgageData = getCanvas.toDataURL("image/png");
                // Now browser starts downloading it instead of just showing it
                var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                $("#btn-Convert-Html2Image").attr("download", "ktmh-<?= strtoupper($snt->nama) ?>.png")
                    .attr("href", newData);
            });

        });
    </script>
</body>

</html>
