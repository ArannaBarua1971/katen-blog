@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="grid columns-2 gap-4">
        <!-- BEGIN: reset Info -->
        <div class="g-col-2 g-col-xl-1 d-none d-xl-flex flex-column    min-vh-screen">
                <a href="{{ route('homepage') }}" class="-intro-x d-flex align-items-center pt-5">
                <img alt="Rubick Bootstrap HTML Admin Template" class="w-6" src="{{ asset('Backend/dist/images/logo.svg') }}">
                <span class="text-white fs-lg ms-3"> Ru<span class="fw-medium">bick</span> </span>
                </a>
                <div class="my-auto">
                <img alt="Rubick Bootstrap HTML Admin Template" class="-intro-x w-1/2 mt-n16" src="{{ asset('Backend/dist/images/illustration.svg') }}">
                <div class="-intro-x text-white fw-medium fs-4xl lh-base mt-10">
                    A few more clicks to 
                    <br>
                    sign in to your account.
                </div>
                <div class="-intro-x mt-5 fs-lg text-white text-opacity-70 dark-text-gray-500">Manage all your e-commerce accounts in one place</div>
                </div>
        </div>
        <!-- END: reset Info -->

        <!-- BEGIN: reset Form -->
        <div class="g-col-2 g-col-xl-1 h-screen h-xl-auto d-flex py-5 py-xl-0 my-10 my-xl-0">
                <div class="my-auto mx-auto ms-xl-20 bg-white dark-bg-dark-1 bg-xl-transparent px-5 px-sm-8 py-8 p-xl-0 rounded-2 shadow-md shadow-xl-none w-full w-sm-3/4 w-lg-2/4 w-xl-auto">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.request') }}">
                            @csrf
    
                            <input type="hidden" name="token" value="{{ $token }}">
    
                            <div class="form-group row">
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="ntro-x login__input form-control py-3 px-4 border-gray-300  d-block mt-3 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
    
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="ntro-x login__input form-control py-3 px-4 border-gray-300  d-block mt-3 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="ntro-x login__input form-control py-3 px-4 border-gray-300  d-block mt-3 form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>
    
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        <!-- END: reset Form -->    
    </div>
</div>


@endsection


