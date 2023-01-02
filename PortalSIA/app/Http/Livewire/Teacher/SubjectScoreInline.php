<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\ScoringSession;
use App\Models\Subject\SubjectScore;

class SubjectScoreInline extends Component
{
    public $subject;
    public $eachStudent;
    public $studentName;
    public $activeScoringSession;
    public $HW1;

    protected $rules = [
        'HW1' => ['required', 'integer', 'min:0', 'max:100']
    ];

    public function mount()
    {
        $this->HW1 = SubjectScore::query()->where('NISN', $this->eachStudent->NISN)->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'HW1')->value('score');
        $this->studentName = $this->eachStudent->name;
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
                                <input class="form-control @error('HW1') is-invalid @enderror" type="number" name="HW1" id="HW1" min="0" max="100" wire:model.lazy="HW1" @if(!\App\Models\ScoringSession::query()->where('type', 'HW1')->where('start_date', '!=', '0000-00-00')->where('end_date', ">=", date("Y-m-d"))->first()) disabled readonly @endif>
                                @error('HW1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control" type="number" name="EX1" id="EX1" min="0" max="100" wire:model.lazy="EX1" @if(!\App\Models\ScoringSession::query()->where('type', 'EX1')->where('start_date', '!=', '0000-00-00')->first()) disabled readonly @endif>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control" type="number" name="MID" id="MID" min="0" max="100" wire:model.lazy="MID" @if(!\App\Models\ScoringSession::query()->where('type', 'MID')->where('start_date', '!=', '0000-00-00')->first()) disabled readonly @endif>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control" type="number" name="HW2" id="HW2" min="0" max="100" wire:model.lazy="HW2" @if(!\App\Models\ScoringSession::query()->where('type', 'HW2')->where('start_date', '!=', '0000-00-00')->first()) disabled readonly @endif>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control" type="number" name="EX2" id="EX2" min="0" max="100" wire:model.lazy="EX2" @if(!\App\Models\ScoringSession::query()->where('type', 'EX2')->where('start_date', '!=', '0000-00-00')->first()) disabled readonly @endif>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control" type="number" name="FIN" id="FIN" min="0" max="100" wire:model.lazy="FIN" @if(!\App\Models\ScoringSession::query()->where('type', 'FIN')->where('start_date', '!=', '0000-00-00')->first()) disabled readonly @endif>
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
        if($this->activeScoringSession->type == 'HW1')
        {
            SubjectScore::query()->updateOrCreate(
                [
                    'NISN' => $this->eachStudent->NISN,
                    'subject_id' => $this->subject,
                    'scoring_session_id' => $this->activeScoringSession->id, 
                ],
                [
                    'id' => Str::uuid(),
                    'subject_id' => $this->subject,
                    'scoring_session_id' => $this->activeScoringSession->id,
                    'score' => $this->HW1
                ]);
        }

        dd("Data Inserted Successfully");
    }
}
