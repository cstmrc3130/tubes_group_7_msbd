<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}} 
    <div class="page-breadcrumb mb-3">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Mata Pelajaran</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Mata Pelajaran</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}} 



    {{-- ========== CONTENT START ========== --}} 
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-info border-bottom pb-3">Daftar Mata Pelajaran</h4>
                    <div id="education_fields" class="m-t-20"></div>

                    <div class="table-responsive" style="overflow: hidden">
                        <table class="table" >
                            <thead class="bg-inverse text-white">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>KKM</th>
                                    <th>Tahun Ajaran</th>
                                </tr>
                            </thead>
                            <tbody class="border border-dark">
                                @foreach(\App\Models\Subject\Subject::query()->where('school_year_id', session('currentSchoolYear'))->paginate(5) as $data)
                                <tr>
                                    <td>{{ $loop->iteration + 5 * ($page - 1) }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->completeness }}</td>
                                    <td>{{ $data->schoolyear->year }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                        {{-- ========== PAGINATION START ========== --}}
                        <div class="row justify-content-center align-items-center my-3">
                            {{ \App\Models\Subject\Subject::query()->where('school_year_id', session('currentSchoolYear'))->paginate(5)->links() }}
                        </div>
                        {{-- ========== PAGINATION END ========== --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== CONTENT START ========== --}} 



    {{-- ========== FOOTER START ========== --}} 
    <footer class="footer text-center m-t-40">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}} 

</div>

@push("additional-style")
    {{-- FOR ALIGNING td TO THE CENTER --}}
    <style>
        tbody td
        {
            vertical-align: middle !important;
        }
    </style>
@endpush