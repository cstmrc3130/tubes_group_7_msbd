<!DOCTYPE html>
<html lang="en">

<head>
    <title>Raport Siswa</title>
    <link rel="icon" type="image/png" sizes="16x16" href=" {{ asset("/assets/images/landing-icon.png") }}">
    <style>
        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        body {
            margin: .2px;
            overflow-x: hidden;
            color: #6a7a8c;
            background: #fff;
        }

        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -ms-overflow-style: scrollbar;
        }

        .table td,
        .table th {
            padding: .2rem;
            vertical-align: top;
            /* border-top: 1px solid #dee2e6; */
            border-bottom: 1px solid #dee2e6
        }

        .table thead th {
            text-align: center;
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6
        }

        .table .table {
            background-color: #f2f4f5
        }

        .table-hover tbody tr:hover {
            background-color: #f6f8f9
        }

        .table-hover tbody tr:hover {
            background-color: #f6f8f9;
        }

        .text-right {
            text-align: right !important;
        }

        * {
            outline: 0;
        }

        \@media (min-width: 768px) .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .col,
        .col-1,
        .col-10,
        .col-11,
        .col-12,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-auto,
        .col-lg,
        .col-lg-1,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-auto,
        .col-md,
        .col-md-1,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-auto,
        .col-sm,
        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-auto,
        .col-xl,
        .col-xl-1,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-auto {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 10px;
            padding-left: 10px;
        }

        .container,
        .container-fluid {
            font-family: serif;
            padding-right: 10px;
            padding-left: 10px;
            /* margin-right: 2rem; */
            /* margin-left: auto; */
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .card {
            margin-bottom: 20px;
        }

        .text-dark {
            color: #343a40 !important;
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1.25rem;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border-radius: 0;
        }

        .text-center {
            text-align: center !important;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        table {
            border-collapse: collapse;
        }

        @page {
            size: auto;   /* auto is the initial value */
            margin: 0;  /* this affects the margin in the printer settings */
        }

        .table {
            font-size: 11px;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body printableArea text-dark">
                    <div class="row" style="border: 2px solid black">
                        <div class="col-md-12">
                            <section class="text-center">
                                <h3>
                                    <b>HASIL BELAJAR SISWA</b>
                                </h3>
                            </section>


                            <section style="margin-bottom: .8rem">
                                <div class="row" style="font-size: .9rem">
                                    <table style="flex-basis: 65%;">
                                        <tbody style="align-items: flex-start; justify-items: self-start; justify-content: start">
                                            <tr>
                                                <td>Nama Madrasah</td>
                                                <td style="width: 5%; text-align: center"> : </td>
                                                <td>MTs Negeri Rantauprapat</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td style="width: 5%; text-align: center"> : </td>
                                                <td style="font-size: 10px">Jl. Kampung Baru Gg. Tsanawiyah No. 150</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Siswa</td>
                                                <td style="width: 5%; text-align: center"> : </td>
                                                <td>{{ $studentName }}</td>
                                            </tr>
                                            <tr>
                                                <td>NISN</td>
                                                <td style="width: 5%; text-align: center"> : </td>
                                                <td>{{ $NISN }}</td>
                                            </tr>
                                            <tr>
                                                <td>Bulan</td>
                                                <td style="width: 5%; text-align: center"> : </td>
                                                <td>{{ $currentMonth }}</td>
                                            </tr>
                                        </tbody>
                                    </table>



                                    <table style="flex-basis: 35%; align-self: start;">
                                        <tbody style="align-self: start; justify-items: self-start; justify-content: start">
                                            <tr>
                                                <td>Kelas</td>
                                                <td style="width: 5%; text-align: center"> : </td>
                                                <td>{{ $class->classroom->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Semester</td>
                                                <td style="width: 5%; text-align: center"> : </td>
                                                <td>{{ $semester }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tahun Ajaran</td>
                                                <td style="width: 5%; text-align: center"> : </td>
                                                <td>{{ \App\Models\SchoolYear::query()->find(session('currentSchoolYear'))->year }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <table class="table">
                                    <thead>
                                        <tr style="font-size: .9rem">
                                            <th style="width: 5%">No.</th>
                                            <th style="width: 35%">Mata Pelajaran</th>
                                            <th style="width: 20%">KKM</th>
                                            <th style="width: 20%">Nilai (Angka)</th>
                                            <th style="width: 20%">Predikat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    
                                        <tr>
                                            <td rowspan="5" style="vertical-align: middle; text-align: center">1</td>
                                            <td style="font-weight: bold">Pendidikan Agama Islam</td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 2rem">a. Qur'an Hadist</td>
                                            <td style="text-align: center">{{ $quranHadistKKM }}</td>
                                            <td style="text-align: center">{{ $quranHadistFinalScore }}</td>
                                            <td style="text-align: center">{{ session("QUR'AN HADITS") }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 2rem">b. Aqidah Akhlak</td>
                                            <td style="text-align: center">{{ $aqidahAkhlakKKM }}</td>
                                            <td style="text-align: center">{{ $aqidahAkhlakFinalScore }}</td>
                                            <td style="text-align: center">{{ session("AQIDAH AKHLAK") }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 2rem">c. Fiqih</td>
                                            <td style="text-align: center">{{ $fiqihKKM }}</td>
                                            <td style="text-align: center">{{ $fiqihFinalScore }}</td>
                                            <td style="text-align: center">{{ session('FIQIH') }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 2rem">d. SKI</td>
                                            <td style="text-align: center">{{ $SKIKKM }}</td>
                                            <td style="text-align: center">{{ $SKIFinalScore }}</td>
                                            <td style="text-align: center">{{ session('SEJARAH KEBUDAYAAN ISLAM') }}</td>
                                        </tr>
    
    
    
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center">2</td>
                                            <td>Pendidikan Kewarganegaraan</td>
                                            <td style="text-align: center">{{ $PKNKKM }}</td>
                                            <td style="text-align: center">{{ $PKNFinalScore }}</td>
                                            <td style="text-align: center">{{ session('PKN') }}</td>
                                        </tr>
    
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center">3</td>
                                            <td>Bahasa dan Sastra Indonesia</td>
                                            <td style="text-align: center">{{ $bahasaIndonesiaKKM }}</td>
                                            <td style="text-align: center">{{ $bahasaIndonesiaFinalScore }}</td>
                                            <td style="text-align: center">{{ session('BAHASA INDONESIA') }}</td>
                                        </tr>
    
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center">4</td>
                                            <td>Bahasa Arab</td>
                                            <td style="text-align: center">{{ $bahasaArabKKM }}</td>
                                            <td style="text-align: center">{{ $bahasaArabFinalScore }}</td>
                                            <td style="text-align: center">{{ session('BAHASA ARAB') }}</td>
                                        </tr>
    
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center">5</td>
                                            <td>Bahasa Inggris</td>
                                            <td style="text-align: center">{{ $bahasaInggrisKKM }}</td>
                                            <td style="text-align: center">{{ $bahasaInggrisFinalScore }}</td>
                                            <td style="text-align: center">{{ session('BAHASA INGGRIS') }}</td>
                                        </tr>
    
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center">6</td>
                                            <td>Matematika</td>
                                            <td style="text-align: center">{{ $matematikaKKM }}</td>
                                            <td style="text-align: center">{{ $matematikaFinalScore }}</td>
                                            <td style="text-align: center">{{ session('MATEMATIKA') }}</td>
                                        </tr>
    
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center">7</td>
                                            <td>Ilmu Pengetahuan Alam</td>
                                            <td style="text-align: center">{{ $IPAKKM }}</td>
                                            <td style="text-align: center">{{ $IPAFinalScore }}</td>
                                            <td style="text-align: center">{{ session('IPA') }}</td>
                                        </tr>
    
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center">8</td>
                                            <td>Ilmu Pengetahuan Sosial</td>
                                            <td style="text-align: center">{{ $IPSKKM }}</td>
                                            <td style="text-align: center">{{ $IPSFinalScore }}</td>
                                            <td style="text-align: center">{{ session('IPS') }}</td>
                                        </tr>
    
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center">9</td>
                                            <td>Kesenian</td>
                                            <td style="text-align: center">{{ $kesenianKKM }}</td>
                                            <td style="text-align: center">{{ $kesenianFinalScore }}</td>
                                            <td style="text-align: center">{{ session('KESENIAN') }}</td>
                                        </tr>
    
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center">10</td>
                                            <td>Seni Budaya</td>
                                            <td style="text-align: center">{{ $seniBudayaKKM }}</td>
                                            <td style="text-align: center">{{ $seniBudayaFinalScore }}</td>
                                            <td style="text-align: center">{{ session('SENI BUDAYA') }}</td>
                                        </tr>
    
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center">11</td>
                                            <td>Pendidikan Jasmani</td>
                                            <td style="text-align: center">{{ $PENJASKKM }}</td>
                                            <td style="text-align: center">{{ $PENJASFinalScore }}</td>
                                            <td style="text-align: center">{{ session('PENJAS') }}</td>
                                        </tr>
    
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center">12</td>
                                            <td>Budi Pekerti</td>
                                            <td style="text-align: center">{{ $BPKKM }}</td>
                                            <td style="text-align: center">{{ $BPFinalScore }}</td>
                                            <td style="text-align: center">{{ session('BP') }}</td>
                                        </tr>
    
                                        <tr style="font-weight: bold">
                                            <td style="vertical-align: middle; text-align: center; "></td>
                                            <td colspan="2">Jumlah Nilai</td>
                                            <td style="text-align: center">
                                                {{ 
                                                    floatval($quranHadistFinalScore + 
                                                    $aqidahAkhlakFinalScore +
                                                    $fiqihFinalScore + 
                                                    $SKIFinalScore +
                                                    $PKNFinalScore +
                                                    $bahasaIndonesiaFinalScore +
                                                    $bahasaArabFinalScore +
                                                    $bahasaInggrisFinalScore +
                                                    $matematikaFinalScore +
                                                    $IPAFinalScore +
                                                    $IPSFinalScore +
                                                    $kesenianFinalScore +
                                                    $seniBudayaFinalScore +
                                                    $PENJASFinalScore +
                                                    $BPFinalScore)
                                                }}
                                            </td>
                                            <td style="text-align: center"></td>
                                        </tr>
    
                                        <tr style="font-weight: bold">
                                            <td style="vertical-align: middle; text-align: center"></td>
                                            <td colspan="2">Rata-rata</td>
                                            <td style="text-align: center">
                                                {{ 
                                                    number_format((float)
                                                    ($quranHadistFinalScore + 
                                                    $aqidahAkhlakFinalScore +
                                                    $fiqihFinalScore + 
                                                    $SKIFinalScore +
                                                    $PKNFinalScore +
                                                    $bahasaIndonesiaFinalScore +
                                                    $bahasaArabFinalScore +
                                                    $bahasaInggrisFinalScore +
                                                    $matematikaFinalScore +
                                                    $IPAFinalScore +
                                                    $IPSFinalScore +
                                                    $kesenianFinalScore +
                                                    $seniBudayaFinalScore +
                                                    $PENJASFinalScore +
                                                    $BPFinalScore) / 15
                                                    , 2, '.', '')
                                                }}
                                            </td>
                                            <td style="text-align: center"></td>
                                        </tr>
    
                                        <tr style="font-weight: bold">
                                            <td style="vertical-align: middle; text-align: center"></td>
                                            <td>Peringkat Kelas</td>
                                            <td colspan="3" style="text-align: center">
                                                <span> 
                                                    <i>
                                                        @foreach ($classRank as $myRank)
                                                            {{ $myRank->nisn == $NISN ? $myRank->rank : "" }}
                                                        @endforeach
                                                    </i> 
                                                </span> 
                                                Dari 
                                                <span> <i>{{ \App\Models\Student\HomeroomClass::query()->where('homeroom_class_id', $class->classroom->id)->where('school_year_id', session('currentSchoolYear'))->count() }}</i></span> 
                                                Siswa
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <h5 style="margin: 0; font-weight: lighter">Tabel interval predikat berdasarkan KKM</h5>
                                <table class="table" style="flex-basis: 100%; align-self: start">
                                    <thead>
                                        <tr>
                                            <th colspan="4">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center">
                                            <td>D = Kurang</td>
                                            <td>C = Cukup</td>
                                            <td>B = Baik</td>
                                            <td>A = Amat Baik</td>
                                        </tr>

                                        <tr style="text-align: center">
                                            <td>0 - 59</td>
                                            <td>60 - 69</td>
                                            <td>70 - 79</td>
                                            <td>80 - 100</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row" style="gap: 5%;">
                                <table class="table" style="flex-basis: 47.5%; align-self: start">
                                    <thead>
                                        <tr>
                                            <th style="text-align: left">Aktivitas Ekstrakurikuler</th>
                                            <th style="text-align: left">Nilai</th>
                                            <th style="text-align: left">Predikat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: left">
                                            <td>{{ $extracurricular }}</td>
                                            <td>{{ $extracurricularScore }}</td>
                                            <td>{{ $extracurricularScore ? session($extracurricular) : "" }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                @if (session('zero-score') != true)
                                                <h4 style="margin-bottom: .25rem;">Berdasarkan nilai akhir, naik ke kelas : {{ substr($class->classroom->name, 0, 1) + 1 }}</h4>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                                <table class="table" style="flex-basis: 47.5%; align-self: start">
                                    <thead>
                                        <tr>
                                            <th colspan="3">Ketidakhadiran</th>
                                        </tr>

                                        <tr>
                                            <td>Sakit</td>
                                            <td>
                                                <span>{{ $totalSickDays }}</span>
                                                Hari
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Izin</td>
                                            <td>
                                                <span>{{ $totalPermittedDays }}</span>
                                                Hari
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Tanpa Keterangan</td>
                                            <td>
                                                <span>{{ $totalAlphaDays }}</span>
                                                Hari
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="row">
                                <table class="table">
                                    <tr style="text-align: center;">
                                        <td style="height: 4rem; border: none; width: 50%">Orang Tua/Wali Siswa</td>
                                        <td style="height: 4rem; border: none; width: 50%">Wali Kelas</td>
                                    </tr>
                                    <tr style="text-align: center;">
                                        <td style="border: none">(___________________)</td>
                                        <td style="border: none">( {{ $homeroomTeacherName }} )</td>
                                    </tr>
                                    <tr style="text-align: center;">
                                        <td style="border: none"></td>
                                        <td style="border: none">NIP. {{ $homeroomTeacherNIP }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>window.print()</script>
</body>

</html>