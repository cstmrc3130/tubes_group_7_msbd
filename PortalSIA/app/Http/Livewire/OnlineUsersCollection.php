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

final class OnlineUsersCollection extends PowerGridComponent
{
    use ActionButton;

    
    // ========== DATA SOURCE (I.E COLLECTION) ========== //
    public function datasource(): ?Collection
    {
        // UNCOMMENT TO SHOW ONLY ONLINE USERS
        // $foundOnline = [];

        // foreach(User::query()->whereNot('role', '0')->get() as $data)
        // {
        //     if($data->isonline())
        //     {
        //         array_push($foundOnline, $data);
        //     }
        // }

        // return collect($foundOnline);

        // SHOW BOTH OFFLINE AND ONLINE USERS
        return User::query()->whereNot('role', '0')->get();
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
                ->addColumn('name', fn (User $model) => ($model->role == 1 ? $model->teacher->name : $model->student->name))
                ->addColumn('role', fn (User $model) => ($model->role == 1 ? e('Guru') : e('Siswa')))
                ->addColumn('status', fn (User $model) => ($model->isonline() ? e('Online') : e('Offline')));
    }

    // ========== CREATING COLUMN FOR TABLE ========== //
    public function columns(): array
    {
        return [
            Column::make('UUID', 'id')->searchable()->sortable(),  
            Column::make('Name', 'name', 'NIP')->searchable()->sortable(),
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
            Rule::rows()->when(function (User $model) 
            {
                return $model->isonline() == false;
            })->setAttribute('class', 'text-danger'),

            // IF USER IS ONLINE SET TEXT AS SUCCESS
            Rule::rows()->when(function (User $model) 
            { 
                return $model->isonline() == true;
            })->setAttribute('class', 'text-success'),

            Rule::button('log-out-online-user')->when(fn(User $model) => $model->isonline() == false)->disable()->caption('Offline'),
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
