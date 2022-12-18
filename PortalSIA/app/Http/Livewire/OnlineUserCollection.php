<?php

namespace App\Http\Livewire;

use App\Models\Student\Student;
use App\Models\Teacher\Teacher;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\Rules\Rule;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class OnlineUserCollection extends PowerGridComponent
{
    use ActionButton;

    public string $sortField = 'status';

    public string $sortDirection = 'desc';

    // ========== DATA SOURCE (I.E COLLECTION) ========== //
    public function datasource(): ?Collection
    {
        // UNCOMMENT TO SHOW ONLY ONLINE USERS
        // $foundOnline = [];

        // foreach(User::query()->whereNot('role', '0')->get() as $data)
        // {
        //     if($data->isonline())
        //     {
        //         array_push($foundOnline, ['id' => $data->id, 'name' => $data->role == 1 ? $data->teacher->name : $data->student->name, 'role' => $data->role, 'status' => $data->isonline() ? true : false]);
        //     }
        // }

        // return collect($foundOnline);

        // SHOW BOTH OFFLINE AND ONLINE USERS
        $foundOnline = [];

        foreach(User::query()->whereNot('role', '0')->get() as $data)
        {
            array_push($foundOnline, ['id' => $data->id, 'name' => $data->role == 1 ? $data->teacher->name : $data->student->name, 'role' => $data->role, 'status' => $data->isonline() ? true : false]);
        }

        return collect($foundOnline);
    }

    // ========== HEADER AND FOOTER FUNCTIONALITY ========== //
    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()->showPerPage(5)->showRecordCount(),
        ];
    }


    // ========== PREPARE DATA SOURCE TO BE USED IN TABLE ========== //
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
                ->addColumn('id')
                ->addColumn('name')
                ->addColumn('role', fn($collection) => $collection->role == 1 ? "Guru" : "Siswa")
                ->addColumn('status', fn($collection) => $collection->status ? "Online" : "Offline");
    }

    // ========== CREATING COLUMN FOR TABLE ========== //
    public function columns(): array
    {
        return [
            Column::make('UUID', 'id')->searchable()->sortable(),  
            Column::make('Name', 'name')->searchable()->sortable(),
            Column::make('Role', 'role')->searchable()->sortable(),
            Column::make('Status', 'status')->searchable()->sortable(),
        ];
    }

    // ========== ACTION BUTTON FOR EACH ROW ========== //
    public function actions(): array
    {
        return [
            Button::add('log-out-online-user')
                ->caption('End Session')
                ->class('btn btn-outline-danger')
                ->emit('ConfirmToEndSession', ['id' => 'id', 'username' => 'name']),
        ];
    }

    // ========== RULES FOR EACH ROWS AND BUTTONS ========== //
    public function actionRules(): array
    {
        return [
            // IF USER IS OFFLINE SET TEXT AS DANGER
            Rule::rows()->when(function ($collection) 
            {
                return $collection->status == false;
            })->setAttribute('class', 'text-danger'),

            // IF USER IS ONLINE SET TEXT AS SUCCESS
            Rule::rows()->when(function ($collection) 
            { 
                return $collection->status == true;
            })->setAttribute('class', 'text-success'),

            Rule::button('log-out-online-user')->when(fn($collection) => $collection->status == false)->disable()->caption('Offline'),
        ];
    }

    // ========== GET LISTENERS FROM ACTION BUTTON ========== //
    protected function getListeners()
    {
        return array_merge(parent::getListeners(), ['ConfirmToEndSession']);
    }

    // ========== DISPATCH THE EVENT ========== //
    public function ConfirmToEndSession(array $data)
    {
        $this->dispatchBrowserEvent('confirm-to-end-session', ['id' => $data['id'], 'username' => $data['username']]);
    }
}
