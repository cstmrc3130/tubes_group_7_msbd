<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Teacher\Teacher;
use App\Models\Student\Student;
use Illuminate\Support\Facades\Auth;

class Directory extends Component
{
    use WithPagination;

    // ========== SEARCH ATTRIBUTES ========== //
    public $keyword;
    public $totalUserFound;
    public $currentPage;

    // ========== MODAL ATTRIBUTES ========== //
    public $name;
    public $NISN;
    public $KARPEG;
    public $NIP;
    public $profilePicture;
    public $class;
    public $subject;
    public $semester;
    public $entryYear;
    public $status;

    // ========== RULES ========== //
    protected $rules = ['keyword' => 'required'];

    // ========== PAGINATION THEME ========== //
    protected $paginationTheme = 'bootstrap';

    // ========== CONSTRUCTOR TO INITIATE PROPERTIES ========== //
    public function mount()
    {
        session()->remove('paginatedTeacher');
        session()->remove('paginatedStudent');

        $this->currentPage = url()->current();
    }

    // ========== RENDER ========== //
    public function render()
    {
        if (Str::contains($this->currentPage, 'teacher') && !session()->has('paginatedTeacher'))
        {
            return view('livewire.directory.teacher')->layout('landing-page', ['title' => "Direktori Guru"]);
        }
        else if(Str::contains($this->currentPage, 'teacher') && session()->has('paginatedTeacher'))
        {
            return view('livewire.directory.teacher', ['paginatedTeacher' => Teacher::search($this->keyword)->paginate(12)])->layout('landing-page', ['title' => "Direktori Guru"]);
        }
        else if(Str::contains($this->currentPage, 'student') && !session()->has('paginatedStudent'))
        {
            return view('livewire.directory.student')->layout('landing-page', ['title' => "Direktori Siswa"]);
        }
        else if(Str::contains($this->currentPage, 'student') && session()->has('paginatedStudent'))
        {
            return view('livewire.directory.student', ['paginatedStudent' => Student::search($this->keyword)->paginate(12)])->layout('landing-page', ['title' => "Direktori Siswa"]);
        }
    }

    // ========== LOGGING OUT WITHOUT RELOAD ========== //
    public function Logout()
    {
        Auth::logout();

        request()->session()->invalidate();
    
        request()->session()->regenerateToken();

        return NULL;
    }

    // ========== SEARCH AND PAGINATE USER ========== //
    public function Search()
    {
        $this->validate();
        $this->totalUserFound = 0;

        $performSearch = Str::contains($this->currentPage, 'teacher') ? 
        Teacher::search($this->keyword) : 
        Student::search($this->keyword);

        foreach($performSearch->get() as $data)
        {
            $this->totalUserFound++;
        }

        Str::contains($this->currentPage, 'teacher') ? 
        session()->put('paginatedTeacher', 'success') : 
        session()->put('paginatedStudent', 'success');
    }

    // ========== INITIATE MODAL ATTRIBUTES ========== //
    public function ShowDetails($primary_key)
    {
        if (Str::contains($this->currentPage, 'teacher'))
        {
            $teacherDetails = Teacher::find($primary_key);

            if($teacherDetails)
            {
                $this->name = $teacherDetails->name;
                $this->NIP = $teacherDetails->NIP;
                $this->KARPEG = $teacherDetails->KARPEG;
                $this->profilePicture = $teacherDetails->user->profile_picture;
                $this->class = $teacherDetails->NIP;
                $this->subject = $teacherDetails->NIP;
            }
            else
            {
                return redirect()->to('directory/teacher');
            }
        }
        else if (Str::contains($this->currentPage, 'student'))
        {
            $studentDetails = Student::find($primary_key);

            if($studentDetails)
            {
                $this->name = $studentDetails->name;
                $this->NISN = $studentDetails->NISN;
                $this->profilePicture = $studentDetails->user->profile_picture;
                $this->class = $studentDetails->NISN;
                $this->semester = $studentDetails->NISN;
                $this->entryYear = $studentDetails->entry_year;
                $this->status = $studentDetails->status;
            }
            else
            {
                return redirect()->to('directory/student');
            }
        }
    }
}