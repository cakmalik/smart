<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biodata</title>
    <style>
        @page {
            margin: 20px;
        }

        @font-face {
            font-family: 'bookman';
            src: url({{ storage_path('fonts/bookman old style.ttf') }}) format("truetype");
        }

        body {
            font-family: "bookman";
            font-size: 12px;
            /* margin: 0px; */
        }

        .capitalize {
            text-transform: capitalize;
        }

        header,
        footer {
            position: fixed;
            left: 0px;
            right: 0px;
        }

        header {
            height: 60px;
            margin-top: -60px;
        }

        footer {
            height: 50px;
            margin-bottom: -50px;
        }
    </style>
    <style>
        #content {
            position: relative;
        }

        #content img {
            position: absolute;
            top: 0px;
            right: 0px;
        }
    </style>
</head>

<body>
    <img src="{{ public_path('bakid/kop.png') }}" alt="" style="width: 100%">
    <div style="text-align:center"><b>
            <h3> <b> BIODATA SANTRI</b></h3>
    </div>

    <div id="content">
        {{-- <img src="{{ public_path('storage/foto_santri/' . $foto) }}" alt="" style="width: 150px;"> --}}
    </div>
    <table class="table table-striped">

        <tr>
            <td style="padding-left: 30px">Nama lengkap</td>
            <td style="width: 300px" class="capitalize">: {{ $student->name }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">NIS</td>
            <td style="width: 300px" class="capitalize">: {{ $student->nis }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Tempat, Tanggal lahir</td>
            <td style="width: 300px" class="capitalize">:
                {{ $student->place_of_birth . ', ' . \Carbon\Carbon::parse($student->date_of_birth)->translatedFormat('d F Y') }}
            </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Jenis kelamin</td>
            <td style="width: 300px" class="capitalize">: {{ $student->gender }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Alamat</td>
            <td style="width: 300px" class="capitalize">: {{ $student->address . ', ' . $student->rt_rw }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Desa</td>
            <td style="width: 300px" class="capitalize">: {{ $student->village }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Kecamatan</td>
            <td style="width: 300px" class="capitalize">: {{ $student->district }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Kota</td>
            <td style="width: 300px" class="capitalize">: {{ $student->city }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Provinsi</td>
            <td style="width: 300px" class="capitalize">: {{ $student->province }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Kode pos</td>
            <td style="width: 300px" class="capitalize">: {{ $student->postal_code }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">No Hp 1</td>
            <td style="width: 300px" class="capitalize">: {{ $student->phone }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">No Hp 2</td>
            <td style="width: 300px" class="capitalize">: {{ $student->parent->father_phone }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Hobi</td>
            <td style="width: 300px" class="capitalize">: {{ $student->hobby }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Cita-cita</td>
            <td style="width: 300px" class="capitalize">: {{ $student->ambition }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Nama ayah</td>
            <td style="width: 300px" class="capitalize">: {{ $student->father_name }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Pendidikan Ayah</td>
            <td style="width: 300px" class="capitalize">: {{ $student->father_education }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">pekerjaan Ayah</td>
            <td style="width: 300px" class="capitalize">: {{ $student->father_job }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Nama Ibu</td>
            <td style="width: 300px" class="capitalize">: {{ $student->mother_name }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Pendidikan ibu</td>
            <td style="width: 300px" class="capitalize">: {{ $student->mother_education }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Pekerjaan ibu</td>
            <td style="width: 300px" class="capitalize">: {{ $student->mother_job }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Asal sekolah</td>
            <td style="width: 300px" class="capitalize">: {{ $student->name }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">NPSN sekolah</td>
            <td style="width: 300px" class="capitalize">: {{ $student->name }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Alamat sekolah asal</td>
            <td style="width: 300px" class="capitalize">:
                {{ $student->name }} </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">No seri ijazah</td>
            <td style="width: 300px" class="capitalize">: {{ $student->name }} </td>
        </tr>
    </table>

    <table style="margin-top: 100px">
        <tr>
            <td align="left" valign="top">

            </td>
            <td align="left" width="200" height="105">
            </td>
            <td align="left" width="150" height="105">
            </td>
            <td align="left" valign="top">
                Lumajang, {{ Carbon\Carbon::now()->isoFormat('D MMMM Y') }} <br>
                Tanda tangan
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="capitalize"> {{ $student->name }}
            </td>
            </td>
        </tr>
    </table>
    <hr>
    <i style="color:slategray; margin-left:40px"> NB: Dokumen ini di bawa ketika validasi data</i>
</body>

</html>
