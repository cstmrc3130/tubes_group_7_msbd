<?php

namespace App\Http\Livewire;

use App\Models\SchoolYear;
use Illuminate\Support\Carbon;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class StudentBuilder extends PowerGridComponent
{
    use ActionButton;

    public string $sortField = 'NISN';
    public string $primaryKey = 'NISN';

    public $NISN, $name, $place_of_birth, $date_of_birth, $father_name, $mother_name, $address, $phone_numbers, $gender;

    // ========== HEADER AND FOOTER FUNCTIONALITY ========== //
    public function setUp(): array
    {
        return [
            Exportable::make('DaftarNamaSiswa_TA_' .  str_replace("/", "-", SchoolYear::query()->find(session('currentSchoolYear'))->year))
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

        // RETUN ALL STUDENTS WHICH ENTRY YEAR IS BETWEEN CURRENT SCHOOL YEAR - 2 TO CURRENT SCHOOL YEAR
        // e.g IF CURRENT SCHOOL YEAR IS 2022/2023, SELECT entry_year BETWEEN 2020 - 2022
        return Student::query()->whereBetween('entry_year', [substr($currentSchoolYear, 0, 4) - 2, substr($currentSchoolYear, 0, 4)]);
    }

    public function relationSearch(): array
    {
        return [];
    }

    // ========== PREPARE DATA SOURCE TO BE USED IN TABLE ========== //
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('NISN')
            ->addColumn('name')
            ->addColumn('homeroom_class_id')
            ->addColumn('homeroom_class_id', fn(Student $model) => $model->homeroomclass != null ? $model->homeroomclass->name : "")
            ->addColumn('place_of_birth')
            ->addColumn('date_of_birth_formatted', fn (Student $model) => Carbon::parse($model->date_of_birth)->format('Y-m-d'))
            ->addColumn('gender', fn (Student $model) => $model->gender == "M" ? "Laki-Laki" : "Perempuan")
            ->addColumn('father_name')
            ->addColumn('mother_name')
            ->addColumn('phone_numbers')
            ->addColumn('status', fn (Student $model) => $model->status == "A" ? "Aktif" : "Tidak Aktif")
            ->addColumn('special_needs', fn (Student $model) => $model->special_needs == "NE" ? "Tidak Ada" : "Ada")
            ->addColumn('address')
            ->addColumn('entry_year')
            ->addColumn('guardian_name', fn (Student $model) => $model->guardian_name == "" ? "Tidak ada" : $model->guardian_name);
    }

    // ========== CREATING COLUMN FOR TABLE ========== //
    public function columns(): array
    {
        return [
            Column::make('NISN', 'NISN')
                ->sortable()
                ->editOnClick(),

            Column::make('CLASS', 'homeroom_class_id')
                ->sortable(),

            Column::make('NAME', 'name')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('PLACE OF BIRTH', 'place_of_birth')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('DATE OF BIRTH', 'date_of_birth_formatted', 'date_of_birth')
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

            Column::make('PHONE NUMBER', 'phone_numbers')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('FATHER NAME', 'father_name')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('MOTHER NAME', 'mother_name')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('GUARDIAN NAME', 'guardian_name')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('ENTRY YEAR', 'entry_year')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('STATUS', 'status')
                ->sortable()
                ->searchable()
                ->editOnClick(),
                
            Column::make('SPECIAL NEEDS', 'special_needs')
                ->sortable()
                ->searchable()
                ->editOnClick(),

        ];
    }

    public function onUpdatedEditable(string $id, string $field, string $value): void
    {
        if ($field != NULL) 
        {
            Student::query()->find($id)->update([$field => $value]);

            $this->dispatchBrowserEvent('success-update', ['field' => $field]);
        }
    }

    // ========== ACTION BUTTON FOR EACH ROW ========== //
    public function actions(): array
    {
        return [
            Button::make('destroy', 'Delete')
                ->class('btn btn-outline-danger')
                ->emit('ConfirmToDeleteStudent', ['NISN' => 'NISN', 'username' => 'name']),
        ];
    }

    // ========== GET LISTENERS FROM ACTION BUTTON ========== //
    protected function getListeners()
    {
        return array_merge(parent::getListeners(), ['ConfirmToDeleteStudent']);
    }

    // ========== DISPATCH THE EVENT ========== //
    public function ConfirmToDeleteStudent(array $data)
    {
        $this->dispatchBrowserEvent('confirm-to-delete-student', ['NISN' => $data['NISN'], 'username' => $data['username']]);
    }

}
