<x-jet-form-section submit="updateProfileInformation">

    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information, username and email address.') }}
    </x-slot>


    <x-slot name="form" class="form form-vertical">
        <div class="row">
            <!-- Profile Photo -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

            <div x-data="{photoName: null, photoPreview: null}" class="text-center">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                            photoName = $refs.photo.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                photoPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.photo.files[0]);
                                    " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="col-md-6 mt-1" x-show="! photoPreview" style="text-align: center; width:100%">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-circle" style="width:100px; height:100px;">
                    </div>

                <!-- New Profile Photo Preview -->
                <div class="col-md-6 mt-1" x-show="photoPreview" style="text-align: center; width:100%;">
                    <span class="d-block rounded-circle mx-auto"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\'); background-size: cover; width: 100px; height: 100px;'">
                    </span>
                </div>

                <button class="btn btn-primary mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </button>

                @if ($this->user->profile_photo_path)
                <button type="button" class="btn btn-primary mt-2" wire:click="deleteProfilePhoto">
                    {{ __('Remove Photo') }}
                </button>
                @endif

                <x-jet-input-error for="photo" class="text-danger mt-1" />
            </div>

            @endif


            <!-- Full Name -->
            <div class="col-12 mt-3">
                <div class="mb-1">
                    <label class="form-label" for="first-name-icon">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                            <input type="text" id="first-name-icon" class="form-control" name="fname-icon" placeholder="Full Name" wire:model.defer="state.name"/>
                        </div>
                        <div class="col-sm-12">
                            <x-jet-input-error for="name" class="text-danger" />
                        </div>
                </div>
            </div>

            <!-- Username -->
            <div class="col-12">
                <div class="mb-1">
                    <label class="form-label" for="username-icon">Username</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                            <input type="text" id="username-icon" class="form-control" name="fname-icon" placeholder="Username" wire:model.defer="state.username"/>
                        </div>
                        <div class="col-sm-12">
                            <x-jet-input-error for="username" class="text-danger" />
                        </div>
                </div>
            </div>

            <!-- Email-->
            <div class="col-12">
                <div class="mb-1">
                    <label class="form-label" for="email-icon">Email</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                            <input type="text" id="email-icon" class="form-control" name="email-icon" placeholder="Email" wire:model.defer="state.email"/>
                        </div>
                        <div class="col-sm-12">
                            <x-jet-input-error for="email" class="text-danger" />
                        </div>
                </div>
            </div>

            <!-- Phone Number -->
            <div class="col-12">
                <div class="mb-1">
                    <label class="form-label" for="phone-icon">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><img
                                src="https://img.icons8.com/external-justicon-lineal-color-justicon/64/000000/external-phone-hotel-essentials-justicon-lineal-color-justicon.png" width="16" height="16" /></span>
                            <input type="text" id="phone-icon" class="form-control" name="phone-icon" placeholder="Phone Number" wire:model.defer="state.phone_no"/>
                        </div>
                        <div class="col-sm-12">
                            <x-jet-input-error for="phone_no" class="text-danger" />
                        </div>
                </div>
            </div>

            <!-- Social Media Link -->
            <div class="col-12">
                <div class="mb-1">
                    <label class="form-label" for="social-icon">Social Media Link</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fab fa-facebook"></i></span>
                            <input type="text" id="social-icon" class="form-control" name="social-icon" placeholder="Phone Number" wire:model.defer="state.social_media"/>
                        </div>
                        <div class="col-sm-12">
                            <x-jet-input-error for="social_media" class="text-danger" />
                        </div>
                </div>
            </div>

            <!-- Short Biography -->
            <div class="col-12">
                <div class="mb-1">
                    <label class="form-label" for="bio-icon">Short Biography</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-info"></i></span>
                                <textarea class="form-control" aria-label="With textarea" wire:model.defer="state.bio"></textarea>
                        </div>
                        <div class="col-sm-12">
                            <x-jet-input-error for="bio" class="text-danger" />
                        </div>
                </div>
            </div>
        </div>
    </x-slot>


    <x-slot name="actions" class="col-md-12 bg-primary">
        <x-jet-action-message class="text-success mr-3 mb-2" on="saved">
            {{ __('Your Information Saved Successfully.') }}
        </x-jet-action-message>

        <button wire:loading.attr="disabled" wire:target="photo" class="btn btn-primary btn-lg p-1" style="width: 300px">
            {{ __('Save Profile Information') }}
        </button>
    </x-slot>
    
</x-jet-form-section>
