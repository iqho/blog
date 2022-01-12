<x-backend-layout>
        @section('title','Profile')

    <div class="card">
            <div class="card-header p-2">
                <h2>{{ __('Profile') }}</h2>
            </div>
            <div class="card-body row p-0">

                    <div class="col-md-6">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.update-profile-information-form')
                        @endif

                        @livewire('profile.logout-other-browser-sessions-form')
                    </div>

                    <div class="col-md-6">
                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            @livewire('profile.update-password-form')
                        <x-jet-section-border />
                        @endif

                        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            @livewire('profile.two-factor-authentication-form')
                        @endif

                        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                            <x-jet-section-border />

                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.delete-user-form')
                            </div>
                        @endif


            </div>
    </div>
</div>

</x-backend-layout>

