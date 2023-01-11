<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\ScoringSession;
use Illuminate\Support\Facades\DB;
use App\Models\Subject\SubjectScore;

class SubjectScoreInline extends Component
{
    public $subject;
    public $eachStudent;
    public $studentName;
    public $activeScoringSession;
    public $HW1, $HW2, $EX1, $EX2, $MID, $FIN;

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
        $this->studentName = $this->eachStudent->name;

        $this->HW1 = SubjectScore::query()->where('NISN', $this->eachStudent->NISN)->where('subject_id', $this->subject)->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'HW1')->where('subject_scores.school_year_id', session('tempSchoolYear'))->value('score');
        $this->EX1 = SubjectScore::query()->where('NISN', $this->eachStudent->NISN)->where('subject_id', $this->subject)->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'EX1')->where('subject_scores.school_year_id', session('tempSchoolYear'))->value('score');
        $this->HW2 = SubjectScore::query()->where('NISN', $this->eachStudent->NISN)->where('subject_id', $this->subject)->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'HW2')->where('subject_scores.school_year_id', session('tempSchoolYear'))->value('score');
        $this->EX2 = SubjectScore::query()->where('NISN', $this->eachStudent->NISN)->where('subject_id', $this->subject)->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'EX2')->where('subject_scores.school_year_id', session('tempSchoolYear'))->value('score');
        $this->MID = SubjectScore::query()->where('NISN', $this->eachStudent->NISN)->where('subject_id', $this->subject)->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'MID')->where('subject_scores.school_year_id', session('tempSchoolYear'))->value('score');
        $this->FIN = SubjectScore::query()->where('NISN', $this->eachStudent->NISN)->where('subject_id', $this->subject)->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'FIN')->where('subject_scores.school_year_id', session('tempSchoolYear'))->value('score');
    }

    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    public function render()
    {
        return <<<'blade'
                    <form class="row align-items-end" @if(!$activeScoringSession == NULL) wire:submit.prevent="UpdateOrCreateScore()" @endif>
                        <div class="col-sm-3 col-md-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" id="name" wire:model="studentName" disabled readonly>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control @error('HW1') is-invalid @enderror" type="number" name="HW1" id="HW1" min="0" max="100" wire:model.lazy="HW1" 
                                    @if(!\App\Models\ScoringSession::query()->where('type', 'HW1')->where('start_date', '!=', '0000-00-00')->where('school_year_id', session('tempSchoolYear'))->where('end_date', ">=", date("Y-m-d"))->first()) disabled readonly @endif
                                    @if(\App\Models\Student\HomeroomClass::query()->where('NISN', $eachStudent->NISN)->value('school_year_id') != session('currentSchoolYear')) disabled readonly @endif>
                                @error('HW1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control @error('EX1') is-invalid @enderror" type="number" name="EX1" id="EX1" min="0" max="100" wire:model.lazy="EX1" 
                                    @if(!\App\Models\ScoringSession::query()->where('type', 'EX1')->where('start_date', '!=', '0000-00-00')->where('school_year_id', session('tempSchoolYear'))->where('end_date', ">=", date("Y-m-d"))->first()) disabled readonly @endif
                                    @if(\App\Models\Student\HomeroomClass::query()->where('NISN', $eachStudent->NISN)->value('school_year_id') != session('currentSchoolYear')) disabled readonly @endif>
                                @error('EX1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control @error('MID') is-invalid @enderror" type="number" name="MID" id="MID" min="0" max="100" wire:model.lazy="MID" 
                                    @if(!\App\Models\ScoringSession::query()->where('type', 'MID')->where('start_date', '!=', '0000-00-00')->where('school_year_id', session('tempSchoolYear'))->where('end_date', ">=", date("Y-m-d"))->first()) disabled readonly @endif
                                    @if(\App\Models\Student\HomeroomClass::query()->where('NISN', $eachStudent->NISN)->value('school_year_id') != session('currentSchoolYear')) disabled readonly @endif>
                                @error('MID')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control @error('HW2') is-invalid @enderror" type="number" name="HW2" id="HW2" min="0" max="100" wire:model.lazy="HW2" 
                                    @if(!\App\Models\ScoringSession::query()->where('type', 'HW2')->where('start_date', '!=', '0000-00-00')->where('school_year_id', session('tempSchoolYear'))->where('end_date', ">=", date("Y-m-d"))->first()) disabled readonly @endif
                                    @if(\App\Models\Student\HomeroomClass::query()->where('NISN', $eachStudent->NISN)->value('school_year_id') != session('currentSchoolYear')) disabled readonly @endif>
                                @error('HW2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control @error('EX2') is-invalid @enderror" type="number" name="EX2" id="EX2" min="0" max="100" wire:model.lazy="EX2" 
                                    @if(!\App\Models\ScoringSession::query()->where('type', 'EX2')->where('start_date', '!=', '0000-00-00')->where('school_year_id', session('tempSchoolYear'))->where('end_date', ">=", date("Y-m-d"))->first()) disabled readonly @endif
                                    @if(\App\Models\Student\HomeroomClass::query()->where('NISN', $eachStudent->NISN)->value('school_year_id') != session('currentSchoolYear')) disabled readonly @endif>
                                @error('EX2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control @error('FIN') is-invalid @enderror" type="number" name="FIN" id="FIN" min="0" max="100" wire:model.lazy="FIN" 
                                    @if(!\App\Models\ScoringSession::query()->where('type', 'FIN')->where('start_date', '!=', '0000-00-00')->where('school_year_id', session('tempSchoolYear'))->where('end_date', ">=", date("Y-m-d"))->first()) disabled readonly @endif
                                    @if(\App\Models\Student\HomeroomClass::query()->where('NISN', $eachStudent->NISN)->value('school_year_id') != session('currentSchoolYear')) disabled readonly @endif>
                                @error('FIN')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-2">
                            <div class="form-group">
                                <button class="btn btn-block btn-outline-success" type="submit" @if($activeScoringSession == NULL) @disabled(true) @endif>
                                    <i class="fa fa-check"></i>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
        blade;
    }

    public function UpdateOrCreateScore()
    {
        DB::beginTransaction();

        try
        {
            if ($this->activeScoringSession->type == 'HW1')
            {
                $this->validateOnly('HW1');

                SubjectScore::query()->updateOrCreate(
                    [
                        'NISN' => $this->eachStudent->NISN,
                        'subject_id' => $this->subject,
                        'school_year_id' => session('tempSchoolYear'),
                        'scoring_session_id' => $this->activeScoringSession->id,
                    ],
                    [
                        'id' => Str::uuid(),
                        'NISN' => $this->eachStudent->NISN,
                        'subject_id' => $this->subject,
                        'school_year_id' => session('tempSchoolYear'),
                        'scoring_session_id' => $this->activeScoringSession->id,
                        'score' => $this->HW1
                    ]
                );
            }

            if ($this->activeScoringSession->type == 'EX1')
            {
                $this->validateOnly('EX1');

                SubjectScore::query()->updateOrCreate(
                    [
                        'NISN' => $this->eachStudent->NISN,
                        'subject_id' => $this->subject,
                        'school_year_id' => session('tempSchoolYear'),
                        'scoring_session_id' => $this->activeScoringSession->id,
                    ],
                    [
                        'id' => Str::uuid(),
                        'NISN' => $this->eachStudent->NISN,
                        'subject_id' => $this->subject,
                        'school_year_id' => session('tempSchoolYear'),
                        'scoring_session_id' => $this->activeScoringSession->id,
                        'score' => $this->EX1
                    ]
                );
            }

            if ($this->activeScoringSession->type == 'MID')
            {
                $this->validateOnly('MID');

                SubjectScore::query()->updateOrCreate(
                    [
                        'NISN' => $this->eachStudent->NISN,
                        'subject_id' => $this->subject,
                        'school_year_id' => session('tempSchoolYear'),
                        'scoring_session_id' => $this->activeScoringSession->id,
                    ],
                    [
                        'id' => Str::uuid(),
                        'NISN' => $this->eachStudent->NISN,
                        'subject_id' => $this->subject,
                        'school_year_id' => session('tempSchoolYear'),
                        'scoring_session_id' => $this->activeScoringSession->id,
                        'score' => $this->MID
                    ]
                );
            }

            if ($this->activeScoringSession->type == 'HW2')
            {
                $this->validateOnly('HW2');

                SubjectScore::query()->updateOrCreate(
                    [
                        'NISN' => $this->eachStudent->NISN,
                        'subject_id' => $this->subject,
                        'school_year_id' => session('tempSchoolYear'),
                        'scoring_session_id' => $this->activeScoringSession->id,
                    ],
                    [
                        'id' => Str::uuid(),
                        'NISN' => $this->eachStudent->NISN,
                        'subject_id' => $this->subject,
                        'school_year_id' => session('tempSchoolYear'),
                        'scoring_session_id' => $this->activeScoringSession->id,
                        'score' => $this->HW2
                    ]
                );
            }

            if ($this->activeScoringSession->type == 'EX2')
            {
                $this->validateOnly('EX2');

                SubjectScore::query()->updateOrCreate(
                    [
                        'NISN' => $this->eachStudent->NISN,
                        'subject_id' => $this->subject,
                        'school_year_id' => session('tempSchoolYear'),
                        'scoring_session_id' => $this->activeScoringSession->id,
                    ],
                    [
                        'id' => Str::uuid(),
                        'NISN' => $this->eachStudent->NISN,
                        'subject_id' => $this->subject,
                        'school_year_id' => session('tempSchoolYear'),
                        'scoring_session_id' => $this->activeScoringSession->id,
                        'score' => $this->EX2
                    ]
                );
            }

            if ($this->activeScoringSession->type == 'FIN')
            {
                $this->validateOnly('FIN');

                SubjectScore::query()->updateOrCreate(
                    [
                        'NISN' => $this->eachStudent->NISN,
                        'subject_id' => $this->subject,
                        'school_year_id' => session('tempSchoolYear'),
                        'scoring_session_id' => $this->activeScoringSession->id,
                    ],
                    [
                        'id' => Str::uuid(),
                        'NISN' => $this->eachStudent->NISN,
                        'subject_id' => $this->subject,
                        'school_year_id' => session('tempSchoolYear'),
                        'scoring_session_id' => $this->activeScoringSession->id,
                        'score' => $this->FIN
                    ]
                );
            }

            DB::commit();

            $this->dispatchBrowserEvent('score-inserted-successfully', ['name' => $this->studentName]);
        }
        catch (\Exception $e)
        {
            DB::rollback();

            $this->dispatchBrowserEvent('score-insertion-failure', ['name' => $this->studentName]);
        }
    }
}
