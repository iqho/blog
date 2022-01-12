<x-backend-layout>
<div>
    @section('title','Profile')

    <div class="card">
        <div class="card-header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Profile') }}
            </h2>
        </div>
        <div class="card-body">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')
            
            <x-jet-section-border />
            @endif







        </div>
    </div>
</x-backend-layout>