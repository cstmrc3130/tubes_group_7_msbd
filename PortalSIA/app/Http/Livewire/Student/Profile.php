<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Student\Student;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rules\Password;

class Profile extends Component
{
    // ========== STUDENT ATTRIBUTES ========== //
    public $profile;
    public $NISN;
    public $name;
    public $placeOfBirth;
    public $dateOfBirth;
    public $gender;
    public $fatherName;
    public $motherName;
    public $address;
    public $phoneNumber;

    // ========== LOGIN ATTRIBUTES ========== //
    public $user;
    public $email;
    public $oldPassword;
    public $newPassword;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = [
        'StudentIntendedToUpdate' => 'UpdateProfileInfo',
    ];

    // ========== RULES ========== //
    protected $rules = ([
        "name" => ['required', "min:5"],
        "placeOfBirth" => ['required', 'string', 'max:20'],
        "dateOfBirth" => ['required', 'date_format:Y-m-d', 'before:12 years ago', 'after:17 years ago'],
        "fatherName" => ['required', 'string', 'min:3', 'max:50'],
        "motherName" => ['required', 'string', 'min:3', 'max:50'],
        'gender' => ['required', 'in:M, F'],
        'address' => ['required', 'string', "max:255"],
        "phoneNumber" => 'required|numeric|min:10',
    ]);

    // ========== CUSTOM VALIDATION MESSAGES ========== //
    protected $messages = (
    [
        // 'placeOfBirth.regex' => 'Tempat lahir hanya boleh huruf'
    ]);

    // ========== CUSTOM :ATTRIBUTES ========== //
    protected $validationAttributes = ([
        // 'placeOfBirth' => 'Tempat Lahir'
    ]);
    
    // ========== CONSTRUCTOR TO INITIATE PROPERTIES ========== //
    public function mount()
    {
        $this->profile = Student::query()->where("NISN", Auth::user()->NISN)->firstOrFail();
        $this->user = Auth::user();
        $this->NISN = $this->user->NISN;
        $this->name = $this->profile->name;
        $this->placeOfBirth = $this->profile->place_of_birth;
        $this->dateOfBirth = $this->profile->date_of_birth;
        $this->gender = $this->profile->gender;
        $this->fatherName = $this->profile->father_name;
        $this->motherName = $this->profile->mother_name;
        $this->address = $this->profile->address;
        $this->phoneNumber = Str::substr($this->profile->phone_numbers, 2, Str::length($this->profile->phone_numbers));;
        $this->email = Auth::user()->email;

        $this->validate();
    }

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);

        $this->dispatchBrowserEvent("toggle-submit-button");
    }

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Profile";
        
        return view('livewire.student.profile')->layout('student.master', compact('title'));
    }
    
    // ========== CHANGE PROFILE PICTURE USING IJABOCROPTOOL ========== //
    public function UpdateProfilePicture(Request $request)
    {
        $request->validate(['select_image' => 'mimes:jpeg,jpg,png']);
        
        $imagePath = "users-profile-pictures/";
        $selectedImage = $request->file('select_image');
        $newImageName =  'UIMG' . date('Ymd') . Str::upper(uniqid('MTSN')) . '.' . $selectedImage->extension();
        
        if ($selectedImage->move(public_path($imagePath), $newImageName))
        {
            // GET COLUMN VALUE FROM DATABASE
            $oldProfilePicture = DB::table("users")->where('id', Auth::user()->id)->value('profile_picture');

            // DELETE USER'S PREVIOUS PROFILE PICTURE
            if ($oldProfilePicture != 'DEFAULT')
            {
                if (File::exists(public_path($imagePath.$oldProfilePicture)))
                {
                    File::delete(public_path($imagePath.$oldProfilePicture));
                }
            }

            \App\Models\User::query()->find(Auth::user()->id)->update(['profile_picture' => $newImageName]);

            return response()->json(['status' => 1, 'msg' => "Profile picture successfully updated"]);
        }
        else
        {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }
    }

    // ========== UPDATE STUDENT PROFILE INFO ========== //
    public function UpdateProfileInfo()
    {
        $this->dispatchBrowserEvent('send-notification-to-admin', ['response' => 'success']);
    }

    // ========== UPDATE STUDENT LOGIN INFO ========== // 
    public function UpdateLoginInfo()
    {
        $this->dispatchBrowserEvent('persisting-last-tab', ['tab-ID' => 'student-login-info']);

        // MAKE INTERVAL FOR EACH UPDATE TO 5 MINUTES
        if (!Cookie::has('cooldown') || now()->diffInMinutes(Cookie::get('cooldown')) > 5)
        {
            if($this->validate(['email' => ['required', 'regex:(gmail)', 'email'], 'oldPassword' => ['required', new MatchOldPassword], 'newPassword' => ['required', Password::min(8), Password::min(8)->letters(), Password::min(8)->mixedCase(), Password::min(8)->numbers(), Password::min(8)->symbols()]]))
            {
                \App\Models\User::query()->find(Auth::id())->update(['email' => $this->email, 'password' => bcrypt($this->newPassword)]);

                $this->dispatchBrowserEvent('login-info-update-result', ['response' => 'success']);

                Cookie::queue('cooldown', now());
            }
        }
        else
        {
            $this->dispatchBrowserEvent('login-info-update-result', ['response' => 'failed']);
        }
    }

}
