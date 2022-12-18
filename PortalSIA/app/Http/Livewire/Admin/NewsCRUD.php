<?php

namespace App\Http\Livewire\Admin;

use App\Models\News;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NewsCRUD extends Component
{
    use WithPagination;

    // ========== NEWS ATTRIBUTES ========== //
    public $newsID;
    public $title;
    public $content;

    // ========== RULES ========== //
    protected $rules = [
        'title' => ['required', 'string', 'min:25', 'max:100'],
        'content' => ['required', 'string'],
    ];

    // ========== EVENT LISTENERS ========== //
    protected $listeners = [
        'DeleteNews',
    ];

    // ========== PAGINATION THEME ========== //
    protected $paginationTheme = 'bootstrap';

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    // ========== CONSTRUCTOR TO INITIATE PROPERTIES ========== //
    public function mount()
    {
        // $this->allNews = News::query()->paginate(3);
    }

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Berita";
        $allNews = News::query()->paginate(3);

        return view('livewire.admin.news', compact('allNews'))->layout('admin.master', compact('title'));
    }

    // ========== UPLOAD IMAGE ========== //
    public function UploadImage(Request $request)
    {
        $request->validate(['file' => 'mimes:jpg,png,jpeg']);

        $imagePath = "news-images/";
        $selectedImage = $request->file('file');
        $newImageName =  'PIMG' . date('Ymd') . Str::upper(uniqid('MTSN')) . '.' . $selectedImage->extension();
        $uploadImage = $selectedImage->storeAs($imagePath, $newImageName, 'public');

        return response()->json(['location' => asset('storage/news-images/' . $newImageName)]);
    }

    // ========== CREATE NEWS ========== //
    public function CreateOrUpdateNews()
    {
        // VALIDATOR TO CATCH ERROR AND SEND TO JAVASCRIPT
        $validator = Validator::make(
            [
                'content'  => $this->content,
            ],
            [
                'content'  => 'required|string',
            ]
        );
    
        if ($validator->fails()) 
        {
            $this->dispatchBrowserEvent('validation-fails');
        } 
        else
        {
            $this->validate();

            News::query()->updateOrCreate(
            [
                'id' => $this->newsID
            ],
            [
                'id' => Str::uuid(),
                'author_id' => Auth::id(),
                'title' => ucwords(strtolower($this->title)),
                'content' => $this->content,
            ]);

            $this->dispatchBrowserEvent('news-created-successfully');
        }
    }

    // ========== CONFIGURE MODAL TO FILL NEWS DATA ========== //
    public function ConfigureNewsModal($news_id)
    {
        $news = News::find($news_id);

        $this->dispatchBrowserEvent('configure-news-modal', ['id' => $news_id, 'title' => $news->title, 'content' => $news->content]);
    }

    // ========== DISPATCH EVENT TO SHOW ALERT ========== //
    public function ShowDeleteAlert($news_id)
    {
        $this->dispatchBrowserEvent('confirm-to-delete-news', ['id' => $news_id]);
    }

    // ========== DELETE NEWS ========== //
    public function DeleteNews($news_id)
    {
        News::query()->find($news_id)->delete();

        $this->dispatchBrowserEvent('success-delete');
    }
}

// P.S
// updateOrCreate WILL CHECK FIRST IN DATABASE IF RECORD ALREADY EXIST WITH 1st ARGUMENT AS SCOPE
    // IF RECORD ALREADY EXIST, IT WILL UPDATE INSTEAD OF CREATING NEW DATA
