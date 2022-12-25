<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;

class SubjectScoreInline extends Component
{
    public $eachStudent;
    public $HW1;

    protected $rules = [
        'HW1' => ['required', 'integer', 'min:0', 'max:100']
    ];

    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    public function render()
    {
        return <<<'blade'
                    <form class="row align-items-end" @if(!\App\Models\ScoringSession::query()->first() == NULL) wire:submit.prevent="UpdateOrCreateScore()" @endif>

                        <div class="col-sm-3 col-md-4">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" id="name" value="{{ $eachStudent->name }}" disabled readonly>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control @error('HW1') is-invalid @enderror" type="number" name="HW1" id="HW1" min="0" max="100" wire:model.lazy="HW1" @if(!\App\Models\ScoringSession::query()->where('type', 'HW1')->first()) disabled readonly @endif>
                                @error('HW1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control" type="number" name="EX1" id="EX1" min="0" max="100" wire:model.lazy="EX1" @if(!\App\Models\ScoringSession::query()->where('type', 'EX1')->first()) disabled readonly @endif>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control" type="number" name="MID" id="MID" min="0" max="100" wire:model.lazy="MID" @if(!\App\Models\ScoringSession::query()->where('type', 'MID')->first()) disabled readonly @endif>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control" type="number" name="HW2" id="HW2" min="0" max="100" wire:model.lazy="HW2" @if(!\App\Models\ScoringSession::query()->where('type', 'HW2')->first()) disabled readonly @endif>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control" type="number" name="EX2" id="EX2" min="0" max="100" wire:model.lazy="EX2" @if(!\App\Models\ScoringSession::query()->where('type', 'EX2')->first()) disabled readonly @endif>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-1">
                            <div class="form-group">
                                <input class="form-control" type="number" name="FIN" id="FIN" min="0" max="100" wire:model.lazy="FIN" @if(!\App\Models\ScoringSession::query()->where('type', 'FIN')->first()) disabled readonly @endif>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-2">
                            <div class="form-group">
                                <button class="btn btn-block btn-outline-success" type="submit" @if(\App\Models\ScoringSession::query()->first() == NULL) @disabled(true) @endif>
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
        dd("Here");
    }
}
