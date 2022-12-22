<?php

namespace App\Http\Livewire;

use App\Models\Subject\SubjectScore;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class SubjectScoreBuilder extends PowerGridComponent
{
    use ActionButton;

    // ========== HEADER AND FOOTER FUNCTIONALITY ========== //
    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage(5)
                ->showRecordCount(),
        ];
    }

    // ========== DATA SOURCE (I.E BUILDER) ========== //
    public function datasource(): Builder
    {
        return SubjectScore::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    // ========== PREPARE DATA SOURCE TO BE USED IN TABLE ========== //
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('subject_id')
            ->addColumn('scoring_session_id')
            ->addColumn('NISN')
            ->addColumn('score');
    }

    // ========== CREATING COLUMN FOR TABLE ========== //
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->searchable(),

            Column::make('SUBJECT ID', 'subject_id')
                ->sortable()
                ->searchable(),

            Column::make('SCORING SESSION ID', 'scoring_session_id')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('NISN', 'NISN')
                ->searchable()
                ->sortable()
                ->editOnClick(),

            Column::make('SCORE', 'score')
                ->searchable()
                ->sortable()
                ->editOnClick(),
        ];
    }

}
