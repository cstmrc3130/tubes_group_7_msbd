<?php

namespace App\Http\Livewire\Admin;

use App\Models\ScoringSession;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class ScoringSessionCRUD extends Component
{
    use WithPagination;

    // ========== CONFIGURATION ATTRIBUTES ========== //
    public $type;
    public $startDate;
    public $endDate;

    // ========== ACTIVE SESSION ATTRIBUTES ========== //
    public $activeType;
    public $activeStartDate;
    public $activeEndDate;

    // ========== RULES ========== //
    protected $rules = ([
        "type" => ['required'],
        "startDate" => ['required', 'date', 'after_or_equal: today'],
        "endDate" => ['required', 'date', 'after: "startDate"'],
    ]);

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    protected $paginationTheme = "bootstrap";

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Sesi Penilaian";
        $sortByLatest = ScoringSession::query()->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->join('school_years', 'scoring_sessions.school_year_id', '=', 'school_years.id')->orderBy('semester', 'DESC');

        $this->activeType = $sortByLatest->value('type');
        $this->activeStartDate = $sortByLatest->value('start_date');
        $this->activeEndDate = $sortByLatest->value('end_date');

        return view('livewire.admin.scoring-session')->layout('admin.master', compact('title'));
    }

    // ========== SET A NEW SCORING SESSION ========== //
    public function SetActiveSession()
    {
        $this->validate();

        ScoringSession::query()->updateOrCreate(
            [
                'type' => $this->type,
                'school_year_id' => session('tempSchoolYear')
            ],
            [
                'id' => Str::uuid(),
                'type' => $this->type,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
                'school_year_id' => session('tempSchoolYear')
            ]
        );

        $this->dispatchBrowserEvent('success-configure-session', ['data' => $this->type]);
    }

    // ========== DISABLE AN ACTIVE SCORING SESSION ========== //
    public function DisableActiveSession()
    {
        $this->dispatchBrowserEvent('scoring-session-disabled', ['data' => $this->activeType]);

        ScoringSession::query()->where('type', $this->activeType)->where('school_year_id', session('tempSchoolYear'))->update(
            [
                'start_date' => NULL,
                'end_date' => NULL
            ]
        );
    }

    // ========== DELETE SCORING SESSION ========== //
    public function DeleteScoringSession($id)
    {
        try
        {
            ScoringSession::query()->find($id)->delete();
            $this->dispatchBrowserEvent('scoring-session-deleted');
        }
        catch (\Illuminate\Database\QueryException $ex)
        {
            $this->dispatchBrowserEvent("data-already-filled");
        }
    }
}
