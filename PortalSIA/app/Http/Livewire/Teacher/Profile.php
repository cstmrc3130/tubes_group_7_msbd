<?php

namespace App\Http\Livewire\Teacher;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Teacher\Teacher;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TeacherNotification;

class Profile extends Component
{
    // ========== TEACHER ATTRIBUTES ========== //
    public $profile;
    public $NIP;
    public $KARPEG;
    public $position;
    public $name;
    public $placeOfBirth;
    public $dateOfBirth;
    public $gender;
    public $address;
    public $phoneNumber;

    // ========== LOGIN ATTRIBUTES ========== //
    public $user;
    public $email;
    public $oldPassword;
    public $newPassword;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = [
        'TeacherIntendedToUpdate' => 'UpdateProfileInfo',
    ];

    // ========== RULES ========== //
    protected $rules = ([
        "name" => ['required', "min:5"],
        "placeOfBirth" => ['required', 'string', 'max:20'],
        "dateOfBirth" => ['required', 'date_format:Y-m-d', 'before:25 years ago', 'after:65 years ago'],
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
        $this->profile = Teacher::query()->where("NIP", Auth::user()->NIP)->firstOrFail();
        $this->user = Auth::user();
        $this->NIP = $this->user->NIP;
        $this->name = $this->profile->name;
        $this->placeOfBirth = $this->profile->place_of_birth;
        $this->dateOfBirth = $this->profile->date_of_birth;
        $this->gender = $this->profile->gender;
        $this->position = $this->profile->position;
        $this->KARPEG = $this->profile->KARPEG;
        $this->address = $this->profile->address;

        // CHECK IF PHONE NUMBER IS 13 IN LENGTH AND IS STARTED WITH 62
        if (Str::length($this->profile->phone_numbers) == 13)
        {
            if (Str::contains(Str::substr($this->profile->phone_numbers, 0, 2), '62'))
            {
                $this->phoneNumber = Str::substr($this->profile->phone_numbers, 2, Str::length($this->profile->phone_numbers));
            }
            elseif (Str::contains(Str::substr($this->profile->phone_numbers, 0, 2), '08'))
            {
                $this->phoneNumber = Str::substr($this->profile->phone_numbers, 1, Str::length($this->profile->phone_numbers));
            }
        }

        // CHECK IF PHONE NUMBER IS 12 IN LENGTH AND IS STARTED WITH 08
        else if (Str::length($this->profile->phone_numbers) == 12)
        {
            if (Str::contains(Str::substr($this->profile->phone_numbers, 0, 2), '08'))
            {
                $this->phoneNumber = Str::substr($this->profile->phone_numbers, 1, Str::length($this->profile->phone_numbers));
            }
        }

        // IF PHONE NUMBER IS ALREADY FORMATTED, DON'T DO ANYTHING
        else
        {
            $this->phoneNumber = $this->profile->phone_numbers;
        }

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

        return view('livewire.teacher.profile')->layout('teacher.master', compact('title'));
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

    // ========== UPDATE TEACHER PROFILE INFO ========== //
    public function UpdateProfileInfo()
    {
        // MAKE INTERVAL FOR EACH UPDATE TO 5 MINUTES
        if (!Cookie::has('cooldown-' . Auth::id()) || now()->diffInMinutes(Cookie::get('cooldown-' . Auth::id())) > 5)
        {
            $admin = User::where('role', '0')->first();

            Teacher::query()->where('NIP', $this->NIP)->update(
                [
                    'name' => $this->name, 
                    'place_of_birth' => $this->placeOfBirth, 
                    'date_of_birth' => $this->dateOfBirth, 
                    'address' => $this->address, 
                    'phone_numbers' => $this->phoneNumber
                ]
            );

            $this->dispatchBrowserEvent('teacher-profile-updated', ['response' => 'success']);

            Cookie::queue('cooldown-' . Auth::id(), now());
        }
        else
        {
            $this->dispatchBrowserEvent('login-info-update-result', ['response' => 'failed']);
        }
    }

    // ========== UPDATE TEACHER LOGIN INFO ========== // 
    public function UpdateLoginInfo()
    {
        $this->dispatchBrowserEvent('persisting-last-tab', ['tab-ID' => 'teacher-login-info']);

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
