<?php

namespace App\Http\Livewire;

use App\Models\SchoolYear;
use Illuminate\Support\Carbon;
use App\Models\Subject\Subject;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class SubjectBuilder extends PowerGridComponent
{
    use ActionButton;

    public $name, $completeness;

    // ========== HEADER AND FOOTER FUNCTIONALITY ========== //
    public function setUp(): array
    {
        return [
            Exportable::make('DaftarMataPelajaran_TA_' .  str_replace("/", "-", SchoolYear::query()->find(session('currentSchoolYear'))->year))
                ->striped('#A6ACCD')
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
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
                ->emit('ConfirmToDeleteSubject', ['id' => 'id', 'name' => htmlspecialchars('name', ENT_NOQUOTES)]),
        ];
    }

    // ========== GET LISTENERS ========== //
    protected function getListeners()
    {
        return array_merge(parent::getListeners(), ['ConfirmToDeleteSubject']);
    }

    // ========== DISPATCH THE EVENT ========== //
    public function ConfirmToDeleteSubject(array $data)
    {
        $this->dispatchBrowserEvent('confirm-to-delete-subject', ['id' => $data['id'], 'name' => htmlspecialchars($data['name'], ENT_NOQUOTES)]);
    }
}
