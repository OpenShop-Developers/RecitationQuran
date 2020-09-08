@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-wrapper">


                <form method="POST" action="{{ route('password.email') }}" class="form">
                    <img src="{{asset('css/img/login-icon.png')}}" alt="">
                    @csrf
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="input-group">

                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input id="email" placeholder="البريد الالكتروني" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <input type="submit" value="ارسال كود التفعيل" class="submit-btn">

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
