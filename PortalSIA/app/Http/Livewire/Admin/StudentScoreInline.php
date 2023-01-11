<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\ScoringSession;
use App\Models\Student\Student;
use Illuminate\Support\Facades\DB;
use App\Models\Subject\SubjectScore;

class StudentScoreInline extends Component
{
    public $subject;
    public $subjectName;
    public $NISN;
    public $HW1, $HW2, $EX1, $EX2, $MID, $FIN;

    protected $listeners = ['SetNISN'];

    protected $rules = [
        'HW1' => ['required', 'integer', 'min:0', 'max:100'],
        'EX1' => ['required', 'integer', 'min:0', 'max:100'],
        'HW2' => ['required', 'integer', 'min:0', 'max:100'],
        'EX2' => ['required', 'integer', 'min:0', 'max:100'],
        'MID' => ['required', 'integer', 'min:0', 'max:100'],
        'FIN' => ['required', 'integer', 'min:0', 'max:100']
    ];

    // ========== CUSTOM :ATTRIBUTES ========== //
    protected $validationAttributes = ([
        'HW1' => 'TUGAS 1',
        'EX1' => 'UJIAN 1',
        'HW2' => 'TUGAS 2',
        'EX2' => 'UJIAN 2',
        'MID' => 'UTS',
        'FIN' => 'UAS'
    ]);

    public function mount()
    {
        $this->subjectName = $this->subject->name;
    }

    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    public function render()
    {        
        return <<<'blade'
                    <form class="row align-items-end" wire:submit.prevent="UpdateOrCreateScore('{{ $subject->id }}')">
                        <div class="col-sm-3 col-md-4">
                            <div class="form-group">
                                <input class="form-control bg-muted" type="text" name="name" id="name" wire:model="subjectName" disabled readonly>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control @error('HW1') is-invalid @enderror" type="number" value="{{ $HW1 }}" name="HW1" id="HW1" min="0" max="100" wire:model.lazy="HW1"> 
                                @error('HW1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control @error('EX1') is-invalid @enderror" type="number" value="{{ $EX1 }}" name="EX1" id="EX1" min="0" max="100" wire:model.lazy="EX1"> 
                                @error('EX1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control @error('MID') is-invalid @enderror" type="number" value="{{ $MID }}" name="MID" id="MID" min="0" max="100" wire:model.lazy="MID"> 
                                @error('MID')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control @error('HW2') is-invalid @enderror" type="number" value="{{ $HW2 }}" name="HW2" id="HW2" min="0" max="100" wire:model.lazy="HW2"> 
                                @error('HW2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control @error('EX2') is-invalid @enderror" type="number" value="{{ $EX2 }}" name="EX2" id="EX2" min="0" max="100" wire:model.lazy="EX2"> 
                                @error('EX2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control @error('FIN') is-invalid @enderror" type="number" value="{{ $FIN }}" name="FIN" id="FIN" min="0" max="100" wire:model.lazy="FIN">
                                @error('FIN')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-2">
                            <div class="form-group">
                                <button class="btn btn-block btn-outline-success" type="submit">
                                    <i class="fa fa-check"></i>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
        blade;
    }

    public function SetNISN($NISN)
    {
        $this->NISN = $NISN;

        $this->HW1 = SubjectScore::query()->where('NISN', $this->NISN)->where('subject_id', $this->subject->id)->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'HW1')->where('subject_scores.school_year_id', session('tempSchoolYear'))->value('score');
        $this->EX1 = SubjectScore::query()->where('NISN', $this->NISN)->where('subject_id', $this->subject->id)->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'EX1')->where('subject_scores.school_year_id', session('tempSchoolYear'))->value('score');
        $this->HW2 = SubjectScore::query()->where('NISN', $this->NISN)->where('subject_id', $this->subject->id)->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'HW2')->where('subject_scores.school_year_id', session('tempSchoolYear'))->value('score');
        $this->EX2 = SubjectScore::query()->where('NISN', $this->NISN)->where('subject_id', $this->subject->id)->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'EX2')->where('subject_scores.school_year_id', session('tempSchoolYear'))->value('score');
        $this->MID = SubjectScore::query()->where('NISN', $this->NISN)->where('subject_id', $this->subject->id)->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'MID')->where('subject_scores.school_year_id', session('tempSchoolYear'))->value('score');
        $this->FIN = SubjectScore::query()->where('NISN', $this->NISN)->where('subject_id', $this->subject->id)->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'FIN')->where('subject_scores.school_year_id', session('tempSchoolYear'))->value('score');
    }

    public function UpdateOrCreateScore($subject_id)
    {
        // TO SHOW INLINE ERROR NOTIFICATION
        // $this->validate();

        $studentsScore = collect(
            [
                'HW1' => $this->HW1,
                'EX1' => $this->EX1,
                'MID' => $this->MID,
                'HW2' => $this->HW2,
                'EX2' => $this->EX2,
                'FIN' => $this->FIN,
            ]);

        DB::beginTransaction();

        try
        {
            $studentsScore->each(function ($value, $key) use ($subject_id)
            {
                // TOAST TO SHOW ERROR MESSAGE
                $this->validateOnly($key);

                SubjectScore::query()->updateOrCreate(
                    [
                        'NISN' => $this->NISN,
                        'subject_id' => $subject_id,
                        'school_year_id' => session('tempSchoolYear'),
                        'scoring_session_id' => ScoringSession::query()->where('school_year_id', session('tempSchoolYear'))->where('type', $key)->first()->id,
                    ],
                    [
                        'id' => Str::uuid(),
                        'NISN' => $this->NISN,
                        'subject_id' => $subject_id,
                        'school_year_id' => session('tempSchoolYear'),
                        'score' => $value,
                        'scoring_session_id' => ScoringSession::query()->where('school_year_id', session('tempSchoolYear'))->where('type', $key)->first()->id,
                    ]
                    );
            });

            DB::commit();

            $this->dispatchBrowserEvent('score-inserted-successfully', ['name' => Student::query()->find($this->NISN)->name]);
        }
        catch (\Exception $e)
        {
            DB::rollback();

            $this->dispatchBrowserEvent('score-insertion-failure', ['name' => Student::query()->find($this->NISN)->name]);
        }
    }
}

// P.S
// VARIABLE SCOPING IS HIGHLY CRUCIAL WHEN CALLING A VARIABLE INSIDE NESTED FUNCTION, TO OVERCOME THIS USE use KEYWORD
