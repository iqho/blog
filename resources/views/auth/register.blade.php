@section('title','Registration Page')
<x-guest-layout>
    <style>
        @media (min-width:978px) {
            .container-fluid {
                margin:0 auto;
                width: 80%;
                padding: 50px;

            }
        }
        @media (max-width:978px) {
            .container-fluid {
                width: 100%;
                padding: 10px;
                margin: 0px;
            }
        }
    </style>
    <!-- BEGIN: Content-->
    <div class="container-fluid">
        <section class="row g-0">
            <div class="card bg-authentication rounded-0 mb-0">
                    <div class="row m-0">
                        <div class="col-lg-5 d-lg-block d-none text-center align-self-center px-0 py-0">
                            <a href="{{ url('/') }}"><img src="http://3.141.149.143/images/pages/login.png" alt="branding logo"></a>
                        </div>
                        <div class="col-lg-7 col-12 p-0">
                            <div class="card rounded-0 mb-0 px-2">
                                <div class="card-header pb-1">
                                    <div class="card-title">
                                        <h2 class="mb-0">New User Registration</h2>
                                    </div>
                                </div>
                                <p class="px-2">Welcome, Please Fillup Require Fields.</p>
                                <div class="card-content">
                                    <x-jet-validation-errors/>
                                    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                                        @csrf
                                        <!-- Name -->
                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="name">{{ __('Name') }}</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Full Name" value="{{ old('name') }}"  autofocus autocomplete="name" required/>
                                                    <div class="invalid-tooltip">Please Enter Name.</div>
                                                </div>
                                                <x-jet-input-error for="name" class="text-danger" />
                                            </div>
                                        </div>

                                        <!-- Username -->
                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="username">{{ __('Username') }}</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                                                    <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Username" value="{{ old('username') }}" required />
                                                    <div class="invalid-tooltip">Please Enter Username.</div>
                                                </div>
                                                <x-jet-input-error for="username" class="text-danger" />
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="email">{{ __('Email') }}</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                                                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Valid Email"
                                                        value="{{ old('email') }}" required />
                                                        <div class="invalid-tooltip">Please Enter a Valid Email Address.</div>
                                                </div>
                                                <x-jet-input-error for="email" class="text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="password">{{ __('Password') }}</label>
                                                <div class="input-group form-password-toggle mb-2">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                                                    <input type="password" id="password" name="password" required autocomplete="new-password"
                                                        class="form-control @error('password') is-invalid @enderror" placeholder="Enter Strong Password" minlength="8">
                                                    <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                            height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg></span>
                                                        <div class="invalid-tooltip">Please Enter a Valid Passwrod with Min Length 8.</div>
                                                </div>
                                                <x-jet-input-error for="password" class="text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <div class="mb-1">
                                                <label class="form-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                                                <div class="input-group form-password-toggle mb-2">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                                        autocomplete="new-password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter Same Password for Confirmation" minlength="8" required>
                                                    <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                            height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg></span>
                                                        <div class="invalid-tooltip ">Please Enter a Valid Passwrod with Min Length 8.</div>
                                                </div>
                                                <x-jet-input-error for="password_confirmation" class="text-danger" />
                                            </div>
                                        </div>

                                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                        <div class="col-12 mt-1">
                                            <x-jet-label for="terms">
                                                <div class="flex items-center">
                                                    <x-jet-checkbox name="terms" id="terms" />

                                                    <div class="ml-2">
                                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                                            class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                                            class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                            </x-jet-label>
                                        </div>
                                        @endif

                                        <div class="row mt-2">
                                            <button type="submit" class="btn btn-primary float-right btn-inline mb-2">Register</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p><a href="{{ url('/') }}">Back to Home</a></p>
                                    </div>
                                    <div class="col-6">
                                        <p>Already Registered ? <a href="{{ route('login') }}">Please Login</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
    </div>

    <!-- End: Content-->

    <script>
        // Self-executing function
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');

                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

</x-guest-layout>

