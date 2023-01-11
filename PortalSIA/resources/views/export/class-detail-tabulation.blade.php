<!DOCTYPE html>
<html lang="en">

<head>
    <title>Export Kelas {{ $class }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(" /assets/images/landing-icon.png") }}">
    <style>
        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        body {
            margin: 0;
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
            padding: .6rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6
        }

        .table thead th {
            text-align: left;
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
            margin-right: 2rem;
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
            border: 0 solid transparent;
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

        .table {
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <section class="text-center">
                                    <h3> &nbsp;<b>DAFTAR NAMA SISWA KELAS {{ $class }}</b></h3>
                                </section>
                                <section>
                                    <p class="m-l-5">
                                        Wali Kelas : {{ $homeroomTeacher }}
                                        <br>
                                        Tahun Ajaran : {{ $schoolYear }}
                                        <br>
                                        Semester : {{ session('currentSemester') }}
                                    </p>
                                </section>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive" style="clear: both;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr style="text-align: left">
                                            <th>No.</th>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach(\App\Models\Student\HomeroomClass::query()->where('homeroom_class_id', request()->segment(count(request()->segments())))->get() as $data) --}}
                                        @foreach(\App\Models\Student\HomeroomClass::select('*')->where('homeroom_class_id', request()->segment(count(request()->segments())))->where('school_year_id', session('currentSchoolYear'))->join('students', 'student_homeroom_classes.NISN', '=', 'students.NISN')->orderBy('students.name', 'ASC')->get() as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->NISN }}</td>
                                            <td>{{ \App\Models\Student\Student::query()->find($data->NISN)->name }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="pull-right m-t-30 text-right">

                                <h3><b>Total Siswa :</b> {{ \App\Models\Student\HomeroomClass::query()->where('homeroom_class_id', request()->segment(count(request()->segments())))->where('school_year_id', session('currentSchoolYear'))->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>