@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="login-wrapper">
                    <form method="POST" action="{{ route('login') }}" class="form">
                        @csrf

                        <img src="{{asset('css/img/login-icon.png')}}" alt="">

                        <div class="input-group">

                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <input id="email" type="email" placeholder="البريد الالكتروني" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="input-group">

                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                            <input id="password" type="password" placeholder="كلمة المرور" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <input type="submit" value="دخول" class="submit-btn">

                        <div class="chek">
                            <input  type="checkbox" name="ch" {{ old('remember') ? 'checked' : '' }}> تذكرني
                            <div class="rem">
                                <hr>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-outline-info" href="{{ route('password.request') }}">
                                        {{ __('هل نسيت كلمة المرور ؟') }}
                                    </a>
                                @endif
                            </div>
                        </div>


                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

