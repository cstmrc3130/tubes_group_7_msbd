<?php

namespace App\Http\Livewire\Admin;

use App\Models\ScoringSession;
use Livewire\Component;
use Illuminate\Support\Str;

class ScoringSessionCRUD extends Component
{
    // ========== CONFIGURATION ATTRIBUTES ========== //
    public $type;
    public $startDate;
    public $endDate;

    // ========== ACTIVE SESSION ATTRIBUTES ========== //
    public $activeType;
    public $activeStartDate;
    public $activeEndDate;

    // ========== EVENT LISTENERS ========== //
    // protected $listeners = ['DeleteStudent'];

    // ========== RULES ========== //
    protected $rules = ([
        "type" => ['required'],
        "startDate" => ['required', 'date', 'after_or_equal: today'],
        "endDate" => ['required', 'date', 'after: "startDate"'],
    ]);

    // ========== CUSTOM :ATTRIBUTES ========== //
    protected $validationAttributes = ([
        // 'NISN' => 'NISN'
    ]);

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Sesi Penilaian";

        $this->activeType = ScoringSession::query()->where('start_date', '>=', date('Y-m-d'))->where('end_date', '>=', 'start_date')->value('type');
        $this->activeStartDate = ScoringSession::query()->where('start_date', '>=', date('Y-m-d'))->where('end_date', '>=', 'start_date')->value('start_date');
        $this->activeEndDate = ScoringSession::query()->where('start_date', '>=', date('Y-m-d'))->where('end_date', '>=', 'start_date')->value('end_date');

        return view('livewire.admin.scoring-session')->layout('admin.master', compact('title'));
    }

    public function SetActiveSession()
    {
        $this->validate();

        ScoringSession::query()->updateOrCreate(
        [
            'type' => $this->type
        ], 
        [
            'id' => Str::uuid(),
            'type' => $this->type,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ]);

        $this->dispatchBrowserEvent('success-configure-session', ['data' => $this->type]);
    }
}
