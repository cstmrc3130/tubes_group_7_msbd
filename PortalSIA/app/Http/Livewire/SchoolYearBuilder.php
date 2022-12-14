<?php

namespace App\Http\Livewire;

use App\Models\SchoolYear;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class SchoolYearBuilder extends PowerGridComponent
{
    use ActionButton;

    // ========== HEADER AND FOOTER FUNCTIONALITY ========== //
    public function setUp(): array
    {
        return [
            Exportable::make('my-export-file')
                ->striped('#A6ACCD')
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage(5, [0, 5, 10, 20, 50])
                ->showRecordCount(),
        ];
    }

    // ========== DATA SOURCE (I.E BUILDER) ========== //
    public function datasource(): Builder
    {
        return SchoolYear::query();
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
            ->addColumn('year')
            ->addColumn('semester');
    }

    // ========== CREATING COLUMN FOR TABLE ========== //
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->searchable(),

            Column::make('SCHOOL YEAR', 'year')
                ->searchable()
                ->sortable(),

            Column::make('SEMESTER', 'semester')
                ->searchable()
                ->sortable(),
        ];
    }

    public function onUpdatedEditable(string $id, string $field, string $value): void
    {
        if ($field != NULL) 
        {
            SchoolYear::query()->find($id)->update([$field => $value]);

            // $this->dispatchBrowserEvent('success-update', ['field' => $field]);
        }
    }

    // ========== ACTION BUTTON FOR EACH ROW ========== //
    public function actions(): array
    {
        return [
            Button::make('set-as-active', 'Set As Active')
                ->class('btn')
                ->emit('SetSchoolYear', ['id' => 'id', 'year' => 'year', 'semester' => 'semester']),
            
            Button::make('destroy', 'Delete')
                ->class('btn btn-outline-danger')
                ->emit('ConfirmToDeleteSchoolYear', ['year' => 'year', 'semester' => 'semester']),
        ];
    }

    // ========== RULES FOR EACH ROWS AND BUTTONS ========== //
    public function actionRules(): array
    {
        return [
            // IF USER IS OFFLINE SET TEXT AS DANGER
            Rule::rows()->when(function ($collection) 
            {
                return $collection->id == session('tempSchoolYear');
            })->setAttribute('class', 'text-success'),

            // IF USER IS ONLINE SET TEXT AS SUCCESS
            Rule::rows()->when(function ($collection) 
            { 
                return $collection->id != session('tempSchoolYear');
            })->setAttribute('class', 'text-muted'),

            Rule::button('set-as-active')->when(fn($collection) => $collection->id == session('tempSchoolYear'))->setAttribute('class', 'btn-success')->setAttribute('disabled')->caption('Currently Active'),
            Rule::button('set-as-active')->when(fn($collection) => $collection->id != session('tempSchoolYear'))->setAttribute('class', 'btn-outline-success'),
        ];
    }

    // ========== GET LISTENERS FROM ACTION BUTTON ========== //
    protected function getListeners()
    {
        return array_merge(parent::getListeners(), ['SetSchoolYear', 'ConfirmToDeleteSchoolYear']);
    }

    // ========== DISPATCH THE EVENT AND SET NEW SCHOOL YEAR ========== //
    public function SetSchoolYear(array $data)
    {
        session()->put('tempSchoolYear', $data['id']);
        session()->put('currentSemester', $data['semester']);

        if($data['semester'] == "Genap")
        {
            session()->put('currentSchoolYear', SchoolYear::query()->where('year', $data['year'])->where('semester', 'Ganjil')->value('id'));
        }
        else
        {
            session()->put('currentSchoolYear', $data['id']);
        }

        $this->dispatchBrowserEvent('set-school-year', ['id' => $data['id'], 'year' => $data['year']]);
    }

    // ========== DISPATCH THE EVENT AND DELETE SCHOOL YEAR ========== //
    public function ConfirmToDeleteSchoolYear(array $data)
    {
        $this->dispatchBrowserEvent('confirm-to-delete-school-year', ['year' => $data['year'], 'semester' => $data['semester']]);
    }
}
