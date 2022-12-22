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
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage(5)
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
            ->addColumn('year');
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
                ->emit('SetSchoolYear', ['id' => 'id', 'year' => 'year']),
        ];
    }

    // ========== RULES FOR EACH ROWS AND BUTTONS ========== //
    public function actionRules(): array
    {
        return [
            // IF USER IS OFFLINE SET TEXT AS DANGER
            Rule::rows()->when(function ($collection) 
            {
                return $collection->id == session('currentSchoolYear');
            })->setAttribute('class', 'text-success'),

            // IF USER IS ONLINE SET TEXT AS SUCCESS
            Rule::rows()->when(function ($collection) 
            { 
                return $collection->id != session('currentSchoolYear');
            })->setAttribute('class', 'text-muted'),

            Rule::button('set-as-active')->when(fn($collection) => $collection->id == session('currentSchoolYear'))->setAttribute('class', 'btn-success')->setAttribute('disabled')->caption('Currently Active'),
            Rule::button('set-as-active')->when(fn($collection) => $collection->id != session('currentSchoolYear'))->setAttribute('class', 'btn-outline-success'),
        ];
    }

    // ========== GET LISTENERS FROM ACTION BUTTON ========== //
    protected function getListeners()
    {
        return array_merge(parent::getListeners(), ['SetSchoolYear']);
    }

    // ========== DISPATCH THE EVENT AND SET NEW SCHOOL YEAR ========== //
    public function SetSchoolYear(array $data)
    {
        session()->put('currentSchoolYear', $data['id']);
        $this->dispatchBrowserEvent('set-school-year', ['id' => $data['id'], 'year' => $data['year']]);
    }
}
