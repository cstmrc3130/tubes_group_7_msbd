<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Filter Mata Pelajaran Guru</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Filter Mata Pelajaran Guru</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}}



    {{-- ========== CONFIGURE SUBJECT START ========== --}}
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                        <h4 class="card-title text-info m-0">Mata Pelajaran : </h4>



                        {{-- ========== FILTER BUTTON START ========== --}}
                        <div class="form-group ml-3 col-4 mb-0">
                            <select class="form-control form-select" name="" id="" wire:model="selectedSubject">
                                <option value=""></option>
                                @foreach(\App\Models\Subject\Subject::query()->where('school_year_id', session('currentSchoolYear'))->get() as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- ========== FILTER BUTTON END ========== --}}



                        <h4 class="card-title text-info m-0 ml-3">Kelas : </h4>



                        {{-- ========== FILTER BUTTON START ========== --}}
                        <div class="form-group ml-3 col-4 mb-0">
                            <select class="form-control form-select" name="" id="" wire:model="selectedClass">
                                <option value=""></option>
                                @if($selectedSubject)
                                    @foreach(\App\Models\Classroom\Classroom::all() as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        {{-- ========== FILTER BUTTON END ========== --}}
                    </div>

                </div>
            </div>
        </div>



        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 id="dynamic-title" class="card-title text-info border-bottom pb-3" wire:ignore>Tabulasi Mata Pelajaran Guru</h4>
                    <div id="education_fields" class="m-t-20"></div>

                    {{-- <button class="btn btn-outline-orange" style="margin-bottom: 1rem" id="export">
                        <i class="ti ti-export"></i>
                        Export as PDF
                    </button> --}}

                    <div class="table-responsive" id="teaching-subject-tabulation">
                        <table class="table" >
                            <thead class="bg-inverse text-white">
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama Guru</th>
                                    <th>Kelas</th>
                                    <th>Tahun Ajaran</th>
                                </tr>
                            </thead>
                            <tbody class="border border-dark">
                                @if($selectedClass)
                                    @foreach(\App\Models\Teacher\TeachingSubject::query()->where('subject_id', $selectedSubject)->where('class_id', $selectedClass)->where('school_year_id', session('currentSchoolYear'))->get() as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->NIP }}</td>
                                        <td>{{ \App\Models\Teacher\Teacher::find($data->NIP)->name }}</td>
                                        <td>{{ \App\Models\Classroom\Classroom::find($data->class_id)->name }}</td>
                                        <td>{{ \App\Models\SchoolYear::find($data->school_year_id)->year }}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    @foreach(\App\Models\Teacher\TeachingSubject::query()->where('subject_id', $selectedSubject)->where('school_year_id', session('currentSchoolYear'))->get() as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->NIP }}</td>
                                        <td>{{ \App\Models\Teacher\Teacher::find($data->NIP)->name }}</td>
                                        <td>{{ \App\Models\Classroom\Classroom::find($data->class_id)->name }}</td>
                                        <td>{{ \App\Models\SchoolYear::find($data->school_year_id)->year }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== CONFIGURE SUBJECT END ========== --}}



    {{-- ========== FOOTER START ========== --}}
    <footer class="footer text-center">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}}

</div>

@push('additional-style')
    {{-- FOR ALIGNING td TO THE CENTER --}}
    <style>
        tbody td
        {
            vertical-align: middle !important;
        }
    </style>
@endpush

@push('additional-script')
    <script>
        $(function ()
        {
            let defaultText = $('#dynamic-title').text();

            $("#teacher-NIP").change(e =>
            {
                $('#dynamic-title').text($(this).find(':selected').text() != "" ? 'Tabulasi Mata Pelajaran ' +  $(this).find(':selected').text() + " (" + $(this).find(':selected').val() + ")" : defaultText)
            })
        })
    </script>
@endpush
