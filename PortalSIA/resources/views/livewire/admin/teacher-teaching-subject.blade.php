<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Mata Pelajaran Guru</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Mata Pelajaran Guru</li>
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
                    <h4 class="card-title text-info border-bottom pb-3">Setting Mata Pelajaran Guru</h4>
                    <div id="education_fields" class=" m-t-20"></div>
                    <form class="row align-items-end" wire:submit.prevent="UpdateOrCreateRecords">
                        <div class="col-sm-3 col-md-12">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <select class="form-control custom-select" wire:model="NIP">
                                    <option value=""></option>
                                    @foreach(\App\Models\Teacher\Teacher::all() as $teacher)
                                    <option value="{{ $teacher->NIP }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @foreach(\App\Models\Teacher\TeachingSubject::query()->where('NIP', $NIP)->get() as $data)
                        <div class="col-sm-2 col-md-12">
                            <div class="alert bg-transparent border-info alert-rounded" id="test"> 
                                <i class="ti-check-box"></i> 
                                Mengajar {{ \App\Models\Subject\Subject::find($data->subject_id)->name }} di kelas {{ \App\Models\Classroom\Classroom::find($data->class_id)->name }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" wire:click="DeleteRecord('{{ $data->id }}')"> 
                                    <span aria-hidden="true">×</span> 
                                </button>
                            </div>
                        </div>
                        @endforeach
                        
                        <div class="col-sm-2 col-md-6">
                            <div class="form-group">
                                <label for="">Mata Pelajaran</label>
                                <select class="form-control custom-select" wire:model="subject">
                                    <option value=""></option>
                                    @foreach(\App\Models\Subject\Subject::all() as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2 col-md-6">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select class="form-control custom-select" wire:model="class">
                                    <option value=""></option>
                                    @foreach(\App\Models\Classroom\Classroom::all() as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @error('class')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <button class="btn btn-outline-info" type="submit">
                                    <i class="fa fa-check-circle"></i>
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== CONFIGURE SUBJECT END ========== --}}



    {{-- ========== FOOTER START ========== --}}
    <footer class="footer text-center">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}}

</div>
@push('additional-script')
@endpush
