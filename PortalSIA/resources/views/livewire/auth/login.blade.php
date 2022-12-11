{{-- ========== LOGIN FORM START ========== --}}
<div id="loginform">
    {{ Form::open(['wire:submit.prevent' => "Login", "class" => ['form-horizontal m-t-20']]) }}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
            </div>
            <input type="text" name="username" class="form-control form-control-lg  @error("username") is-invalid @enderror" placeholder="Username" aria-label="username" aria-describedby="basic-addon1" required wire:model.defer="username">

            @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
            </div>
            <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror " placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required wire:model.defer="password">

            @error("password")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <a href="javascript:void(0)" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Forgot password?</a>
            </div>
        </div>

        <div class="form-group text-center">
            <div class="col-xs-12">
                <button class="btn btn-block btn-lg btn-info" type="submit" wire:click="Login">Log In</button>
            </div>
        </div>
    {{ Form::close() }}
</div>
{{-- ========== LOGIN FORM END ========== --}}