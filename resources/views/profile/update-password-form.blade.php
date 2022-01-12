<x-jet-form-section submit="updatePassword">

    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form" class="form form-vertical">
        <div class="row">

            <!-- Current Password-->
            <div class="col-12">
                <div class="mb-1">
                    <label class="form-label" for="first-name-icon">Current Password</label>
                        <div class="input-group form-password-toggle">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                            <input id="current_password" type="password" class="form-control" wire:model.defer="state.current_password" autocomplete="current-password" />
                            <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off font-small-4"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg></span>
                        </div>
                        <div class="col-sm-12">
                            <x-jet-input-error for="current_password" class="text-danger" />
                        </div>
                </div>
            </div>

            <!-- New Password-->
            <div class="col-12">
                <div class="mb-1">
                    <label class="form-label" for="first-name-icon">New Password</label>
                        <div class="input-group form-password-toggle">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
                            <input id="password" type="password" class="form-control" wire:model.defer="state.password" autocomplete="password" />
                            <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off font-small-4"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg></span>
                        </div>
                        <div class="col-sm-12">
                            <x-jet-input-error for="password" class="text-danger" />
                        </div>
                </div>
            </div>

            <!-- Confirm New Password-->
            <div class="col-12">
                <div class="mb-1">
                    <label class="form-label" for="first-name-icon">Confirm New Password</label>
                        <div class="input-group form-password-toggle">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
                            <input id="password_confirmation" type="password" class="form-control" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                            <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off font-small-4"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg></span>
                        </div>
                        <div class="col-sm-12">
                            <x-jet-input-error for="password_confirmation" class="text-danger" />
                        </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3 mb-2" on="saved">
            {{ __('New Password Save Successfully !') }}
        </x-jet-action-message>

        <button class="btn btn-primary btn-lg p-1" style="width: 300px">
            {{ __('Save New Password') }}
        </button>
    </x-slot>

</x-jet-form-section>
