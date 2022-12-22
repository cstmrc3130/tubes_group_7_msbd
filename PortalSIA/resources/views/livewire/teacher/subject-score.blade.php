<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Nilai Mata Pelajaran</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Nilai Mata Pelajaran</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}}



    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-info border-bottom pb-3">Mata Pelajaran & Kelas</h4>
                    <div class="row align-items-end">
                        <div class="col-sm-3 col-md-6">
                            <div class="form-group">
                                <label for="">Mata Pelajaran</label>
                                <select class="form-control form-select" wire:model="dynamicSubject">
                                    <option value=""></option>
                                    @foreach(\App\Models\Teacher\TeachingSubject::query()->where('NIP', auth()->user()->NIP)->groupBy('subject_id')->get() as $subject)
                                        <option value="{{ $subject->subject_id }}">{{ $subject->subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-6">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select class="form-control form-select" >
                                    <option value=""></option>
                                    @foreach($dynamicClass as $class)
                                        <option value="{{ $class->class_id }}">{{ $class->classroom->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-info border-bottom pb-3">Nilai Siswa</h4>
                    <form class="row align-items-end" wire:submit.prevent="UpdateOrCreateScore">
                        <div class="col-sm-3 col-md-12">
                            <div class="form-group">
                                <label for="">Tabulasi Nilai Siswa</label>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- ========== FOOTER START ========== --}} 
    <footer class="footer text-center mt-5">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}} 

</div>
