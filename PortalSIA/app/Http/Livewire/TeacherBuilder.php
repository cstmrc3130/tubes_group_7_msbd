<?php

namespace App\Http\Livewire;

use App\Models\SchoolYear;
use App\Models\Teacher\Teacher;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class TeacherBuilder extends PowerGridComponent
{
    use ActionButton;

    public string $sortField = 'NIP';
    public string $primaryKey = 'NIP';

    public $NIP, $KARPEG, $position, $name, $place_of_birth, $date_of_birth, $graduated_at, $graduated_from, $address, $phone_numbers, $started_working_at;
    
    // ========== HEADER AND FOOTER FUNCTIONALITY ========== //
    public function setUp(): array
    {
        return [
            Exportable::make('DaftarNamaGuru_TA_' .  str_replace("/", "-", SchoolYear::query()->find(session('currentSchoolYear'))->year))
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
        $currentSchoolYear = SchoolYear::query()->find(session('currentSchoolYear'))->year;

        return Teacher::query()->where('started_working_at', '<=', substr($currentSchoolYear, 5, strlen($currentSchoolYear)));
    }

    public function relationSearch(): array
    {
        return [];
    }

    // ========== PREPARE DATA SOURCE TO BE USED IN TABLE ========== //
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('NIP')
            ->addColumn('KARPEG')
            ->addColumn('position')
            ->addColumn('homeroom_class_id')
            ->addColumn('homeroom_class_id', fn(Teacher $model) => $model->homeroomclass != null ? $model->homeroomclass->name : NULL)
            ->addColumn('name')
            ->addColumn('place_of_birth')
            ->addColumn('date_of_birth', fn (Teacher $model) => Carbon::parse($model->date_of_birth)->format('Y-m-d'))
            ->addColumn('gender', fn (Teacher $model) => $model->gender == "M" ? "Laki-Laki" : "Perempuan")
            ->addColumn('address')
            ->addColumn('phone_numbers')
            ->addColumn('graduated_from')
            ->addColumn('graduated_at')
            ->addColumn('started_working_at');
    }

    // ========== CREATING COLUMN FOR TABLE ========== //
    public function columns(): array
    {
        return [
            Column::make('NIP', 'NIP')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('KARPEG', 'KARPEG')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('POSITION', 'position')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('CLASS', 'homeroom_class_id')
                ->sortable()
                ->searchable(),

            Column::make('NAME', 'name')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('PLACE OF BIRTH', 'place_of_birth')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('DATE OF BIRTH', 'date_of_birth', 'date_of_birth')
                ->searchable()
                ->sortable()
                ->editOnClick(),

            Column::make('GENDER', 'gender')
                ->sortable()
                ->searchable(),

            Column::make('ADDRESS', 'address')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('GRADUATED FROM', 'graduated_from')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('GRADUATED AT', 'graduated_at')
                ->sortable()
                ->editOnClick(),

            Column::make('STARTED WORKING AT', 'started_working_at')
                ->sortable()
                ->editOnClick(),
        ];
    }

    public function onUpdatedEditable(string $id, string $field, string $value): void
    {
        if ($field != NULL) 
        {
            Teacher::query()->find($id)->update([$field => $value]);

            $this->dispatchBrowserEvent('success-update', ['field' => $field]);
        }
    }

    // ========== ACTION BUTTON FOR EACH ROW ========== //
    public function actions(): array
    {
        return [
            Button::make('destroy', 'Delete')
                ->class('btn btn-outline-danger')
                ->emit('ConfirmToDeleteTeacher', ['NIP' => 'NIP', 'username' => 'name']),
        ];
    }

    // ========== GET LISTENERS FROM ACTION BUTTON ========== //
    protected function getListeners()
    {
        return array_merge(parent::getListeners(), ['ConfirmToDeleteTeacher']);
    }

    // ========== DISPATCH THE EVENT ========== //
    public function ConfirmToDeleteTeacher(array $data)
    {
        $this->dispatchBrowserEvent('confirm-to-delete-teacher', ['NIP' => $data['NIP'], 'username' => $data['username']]);
    }
}
