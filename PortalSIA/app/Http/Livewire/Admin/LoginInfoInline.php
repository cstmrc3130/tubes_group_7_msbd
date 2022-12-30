<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class LoginInfoInline extends Component
{
    // ========== NOTIFICATION ATTRIBUTES ========== //
    public $email, $oldPassword, $newPassword;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = ['AbortUpdate', 'ApproveUpdate'];

    // ========== RENDER ========== //
    public function render()
    {
        return <<<'blade'
            <div class="modal fade show" id="loginInfoModal" tabindex="-1" role="dialog" aria-labelledby="loginInfoModalLabel1" wire:ignore.self>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="loginInfoModalLabel1">Informasi Login</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="login-info-form" wire:submit.prevent="UpdateLoginInfo()">
                                <div class="row">
                                    
                                    {{-- ========== OLD DATA START ========== --}}
                                    <div class="col-12">
                                        
                                        {{-- ========== EMAIL START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('email', 'Email', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-9">
                                                {{ Form::email('email', Auth::user()->email, ['class' => 'form-control form-control-line'.($errors->has('email') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'email', 'required', 'wire:model.defer' => 'email']) }}
                                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        {{-- ========== EMAIL START ========== --}}



                                        {{-- ========== OLD PASSWORD START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('old_password', 'Kata Sandi Lama', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-9">
                                                {{ Form::password('old_password', ['class' => 'form-control form-control-line'.($errors->has('oldPassword') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'old_password', 'required', 'wire:model.defer' => 'oldPassword']) }}
                                                @error('oldPassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        {{-- ========== OLD PASSWORD START ========== --}}



                                        {{-- ========== NEW PASSWORD START ========== --}}
                                        <div class="form-group row">
                                            {{ Form::label('new_password', 'Kata Sandi Baru', ["class" => "col-md-3 col-form-label"]) }}
                                            <div class="col-md-9">
                                                {{ Form::password('new_password', ['class' => 'form-control form-control-line'.($errors->has('newPassword') ? ' is-invalid' : ''), 'autocomplete' => 'off', 'id' => 'new_password', 'required', 'wire:model.defer' => 'newPassword']) }}
                                                @error('newPassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        {{-- ========== NEW PASSWORD START ========== --}}

                                    </div>
                                    {{-- ========== OLD DATA END ========== --}}

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" id="save" class="btn btn-info" >Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        blade;
    }

    // ========== UPDATE LOGIN INFO ========== //
    public function UpdateLoginInfo()
    {
        if($this->validate(['email' => ['required'], 'oldPassword' => ['required', new MatchOldPassword], 'newPassword' => ['required', Password::min(8), Password::min(8)->letters(), Password::min(8)->mixedCase(), Password::min(8)->numbers(), Password::min(8)->symbols()]]))
        {
            \App\Models\User::query()->find(Auth::id())->update(['email' => $this->email, 'password' => bcrypt($this->newPassword)]);

            $this->dispatchBrowserEvent('update-success');
        }
    }
}
