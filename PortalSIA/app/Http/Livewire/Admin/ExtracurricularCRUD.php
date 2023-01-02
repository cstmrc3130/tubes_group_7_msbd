<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Extracurricular\Extracurricular;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ExtracurricularCRUD extends Component
{
    use WithFileUploads, WithPagination;

    // ========== EXTRACURRICULAR ATTRIBUTES ========== //
    public $extracurricularID;
    public $name;
    public $description;
    public $image;
    public $schoolYear;

    // ========== RULES ========== //
    protected $rules = [
        'name' => ['required', 'string', 'max:100'],
        'description' => ['required', 'string'],
        'image' => 'image|max:1024',
    ];

    // ========== EVENT LISTENERS ========== //
    protected $listeners = [
        'DeleteExtracurricular',
    ];

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    // ========== CONSTRUCTOR TO INITIATE ATTRIBUTES ========== //
    public function mount()
    {
        $this->schoolYear = \App\Models\SchoolYear::find(session('currentSchoolYear'))->year;
    }

    // ========== PAGINATION THEME ========== //
    protected $paginationTheme = 'bootstrap';

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Ekstrakurikuler";
        $allExtracurriculars = Extracurricular::query()->paginate(3);

        return view('livewire.admin.extracurricular-list', compact('allExtracurriculars'))->layout('admin.master', compact('title'));
    }

    // ========== CREATE OR UPDATE EXTRACURRICULAR ========== //
    public function CreateOrUpdateExtracurricular()
    {
        $this->validate();

        $imagePath = $this->image->store('extracurricular-images', 'public');

        Extracurricular::query()->updateOrCreate(
            [
                "id" => $this->extracurricularID,
            ],
            [
                'id' => Str::uuid(),
                'school_year_id' => session('currentSchoolYear'),
                'name' => $this->name,
                'description' => $this->description,
                'image' => $imagePath
            ]);

        $this->emit('success-create-extracurricular');
    }

    // ========== CONFIGURE MODAL TO FILL EXTRACURRICULAR DATA ========== //
    public function ConfigureExtracurricularModal($extracurricular_id)
    {
        $extracurricular = Extracurricular::find($extracurricular_id);

        $this->dispatchBrowserEvent('configure-extracurricular-modal', ['id' => $extracurricular_id, 'name' => $extracurricular->name, 'description' => $extracurricular->description, 'image' => $extracurricular->image]);
    }

    // ========== DISPATCH EVENT TO SHOW ALERT ========== //
    public function ShowDeleteAlert($extracurricular_id)
    {
        $extracurricular = Extracurricular::find($extracurricular_id);

        $this->dispatchBrowserEvent('confirm-to-delete-extracurricular', ['id' => $extracurricular_id, 'name' => $extracurricular->name]);
    }

    // ========== DELETE EXTRACURRICULAR ========== //
    public function DeleteExtracurricular($extracurricular_id)
    {
        Extracurricular::query()->find($extracurricular_id)->delete();

        $this->dispatchBrowserEvent('success-delete');
    }
}
