<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Extracurricular\ExtracurricularScore;

class ExtracurricularScoreInline extends Component
{
    public $extracurricular;
    public $eachStudent;
    public $studentName;
    public $score;

    protected $rules = [
        'score' => ['required', 'integer', 'min:0', 'max:100'],
    ];

    // ========== CUSTOM :ATTRIBUTES ========== //
    protected $validationAttributes = ([]);

    public function mount()
    {
        $this->studentName = $this->eachStudent->name;

        $this->score = ExtracurricularScore::query()->where('NISN', $this->eachStudent->NISN)->where('extracurricular_id', $this->extracurricular)->value('score');
    }

    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    public function render()
    {
        return <<<'blade'
                    <form class="row align-items-end" wire:submit.prevent="UpdateOrCreateScore()">
                        <div class="col-sm-3 col-md-5">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" id="name" wire:model="studentName" disabled readonly>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-5">
                            <div class="form-group">
                                <input class="form-control @error('score') is-invalid @enderror" type="number" name="score" id="score" min="0" max="100" wire:model.lazy="score">
                                @error('score')<div class="invalid-feedback">{{ $message }}</div>@enderror
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

    public function UpdateOrCreateScore()
    {
        DB::beginTransaction();

        try
        {
            $this->validateOnly('score');

            ExtracurricularScore::query()->updateOrCreate(
                [
                    'NISN' => $this->eachStudent->NISN,
                    'extracurricular_id' => $this->extracurricular,
                ],
                [
                    'id' => Str::uuid(),
                    'NISN' => $this->eachStudent->NISN,
                    'extracurricular_id' => $this->extracurricular,
                    'score' => $this->score
                ]
            );

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
