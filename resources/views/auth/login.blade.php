    @extends('layouts.app')

@section('content')
<div class="container ">
    <div class="grid columns-2 gap-4">

             <!-- BEGIN: Login Info -->
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
            <!-- END: Login Info -->

            <!-- BEGIN: Login Form -->
            <div class="g-col-2 g-col-xl-1 h-screen h-xl-auto d-flex py-5 py-xl-0 my-10 my-xl-0">
                <div class="my-auto mx-auto ms-xl-20 bg-white dark-bg-dark-1 bg-xl-transparent px-5 px-sm-8 py-8 p-xl-0 rounded-2 shadow-md shadow-xl-none w-full w-sm-3/4 w-lg-2/4 w-xl-auto">
                    <h2 class="intro-x fw-bold fs-2xl fs-xl-3xl text-center text-xl-start">
                        Sign In
                    </h2>
                    <div class="intro-x mt-2 text-gray-500 d-xl-none text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf      
                            <div class="intro-x mt-8">
                                <input type="text" value="{{ old('email') }}" name="email" class="intro-x login__input form-control py-3 px-4 border-gray-300  d-block   @error('email') is-invalid @enderror" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block mt-4  @error('password') is-invalid   @enderror" name="password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="intro-x mt-5 mt-xl-8 text-center text-xl-start">
                                <button class="btn btn-primary py-3 px-4 w-full w-xl-32 me-xl-3 align-top" >{{ __('Login') }}</button>
                                <a class="btn btn-outline-secondary py-3 px-4 w-full w-xl-32 mt-3 mt-xl-0 align-top" href="{{ route('register') }}">Sign up</a>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">    
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            forget your password?
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('redirect.anotherLogin',"google") }}" class="btn">
                            Login With Google
                        </a>
                        <a href="{{ route('facebook.anotherLogin') }}" class="btn">
                            Login With facebook
                        </a>
                        <div class="intro-x mt-10 mt-xl-24 text-gray-700 dark-text-gray-600 text-center text-xl-start">
                            By signin up, you agree to our 
                            <br>
                            <a class="text-theme-1 dark-text-theme-10" href="login-light-login.html">Terms and Conditions</a> & <a class="text-theme-1 dark-text-theme-10" href="login-light-login.html">Privacy Policy</a> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Login Form -->

           
    </div>
</div>

@endsection


