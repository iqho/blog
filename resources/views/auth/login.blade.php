@section('title','Login')
<x-guest-layout>

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-10 col-11 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                    <img src="http://3.141.149.143/images/pages/login.png" alt="branding logo">
                                </div>
                                <div class="col-lg-6 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">Login</h4>
                                            </div>
                                        </div>
                                        <p class="px-2">Welcome back, please login to your account.</p>
                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                            @if (session('status'))
                                                <div class="mb-1 text-success">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            @if (session('block-warning'))
                                                <div class="mb-1 text-danger">
                                                    {{ session('block-warning') }}
                                                </div>
                                            @else
                                                <x-jet-validation-errors />
                                            @endif


                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf

                                                <!-- Username -->
                                                <div class="col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="username-icon">{{ __('Email / Username / Phone No') }}</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                                                                <input type="text" id="email" class="form-control" name="email" placeholder="Email / Username / Phone No" :value="old('email')" required autofocus/>
                                                            </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="first-name-icon">{{ __('Password') }}</label>
                                                        <div class="input-group form-password-toggle mb-2">
                                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                                                            <input type="password" id="password" name="password" required autocomplete="current-password" class="form-control" placeholder="Your Password">
                                                            <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-1">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember" value="checked" checked="">
                                                            <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="text-align:right; width:100%; margin-top:10px">
                                                    @if (Route::has('password.request'))
                                                    <a class="card-link" href="{{ route('password.request') }}">
                                                        {{ __('Forgot your password?') }}
                                                    </a>
                                                    @endif
                                                </div>

                                                <div class="row mt-2">
                                                    <button type="submit" class="btn btn-primary float-right btn-inline mb-2">Login</button>
                                                </div>
                                                </form>
                                                <div style="display: inline-block;width: 100%;text-align:right;">
                                                    <p>Don't have an account ? <a href="{{ route('register') }}">Register</a></p>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- End: Content-->
</x-guest-layout>
