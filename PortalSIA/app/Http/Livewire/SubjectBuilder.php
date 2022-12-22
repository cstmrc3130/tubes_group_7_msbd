<?php

namespace App\Http\Livewire;

use App\Models\Subject\Subject;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class SubjectBuilder extends PowerGridComponent
{
    use ActionButton;

    public $name, $completeness;

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
        return Subject::query()->where('school_year_id', session('currentSchoolYear'));
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
            ->addColumn('name')
            ->addColumn('school_year_id')
            ->addColumn('school_year_id', fn(Subject $model) => $model->schoolyear->year)
            ->addColumn('completeness');
    }

    // ========== CREATING COLUMN FOR TABLE ========== //
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->searchable(),

            Column::make('SCHOOL YEAR', 'school_year_id')
                ->sortable()
                ->searchable(),

            Column::make('NAME', 'name')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('COMPLETENESS', 'completeness')
                ->searchable()
                ->sortable()
                ->editOnClick(),
        ];
    }

    public function onUpdatedEditable(string $id, string $field, string $value): void
    {
        if ($field != NULL) 
        {
            Subject::query()->find($id)->update([$field => $value]);

            $this->dispatchBrowserEvent('success-update', ['field' => $field]);
        }
    }

    // ========== ACTION BUTTON FOR EACH ROW ========== //
    public function actions(): array
    {
        return [
            Button::make('destroy', 'Delete')
                ->class('btn btn-outline-danger')
                ->emit('ConfirmToDeleteSubject', ['id' => 'id', 'name' => 'name']),
        ];
    }

    // ========== GET LISTENERS FROM ACTION BUTTON ========== //
    protected function getListeners()
    {
        return array_merge(parent::getListeners(), ['ConfirmToDeleteSubject']);
    }

    // ========== DISPATCH THE EVENT ========== //
    public function ConfirmToDeleteSubject(array $data)
    {
        $this->dispatchBrowserEvent('confirm-to-delete-subject', ['id' => $data['id'], 'name' => $data['name']]);
    }
}
