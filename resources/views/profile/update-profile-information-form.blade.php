<x-jet-form-section submit="updateProfileInformation">
<div class="card">
        <div class="card-header">
            <x-slot name="title">
                    {{ __('Profile Information') }}
                </x-slot>
                
                <x-slot name="description">
                    {{ __('Update your account\'s profile information and email address.') }}
                </x-slot>
        </div>
        <div class="card-body">
 <x-slot name="form"> 
     <div class="row p-3">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
       
        <div x-data="{photoName: null, photoPreview: null}" class="col-md-4">
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
            <div class="col-md-6 mt-2" x-show="! photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                    class="rounded-circle" style="width:100px; height:100px;">
            </div>
   
            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview">
                <span class="d-block rounded-circle w-20 h-20"
                    x-bind:style="'background-image: url(\'' + photoPreview + '\'); background-size: cover; width: 100px; height: 100px'">
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
    <div class="col-md-8">

        <!-- Name -->
        <div class="input-group">
            <div class="col-sm-12 mt-1">{{ __('Name') }}</div>
            <span class="input-group-text" id="basic-addon1">🙎‍♂️</span>
            <input type="text" class="form-control" id="Username" placeholder="Username" aria-label="Username"
                aria-describedby="basic-addon1" wire:model.defer="state.name"
                autocomplete="name" />
            <div class="col-sm-12">
                <x-jet-input-error for="name" class="text-danger" />
            </div>
        </div>

        <!-- Username -->
        <div class="input-group">
            <div class="col-sm-12 mt-1">{{ __('Username') }}</div>
            <span class="input-group-text" id="basic-addon1"><img src="https://img.icons8.com/ios-filled/50/000000/username.png" width="16" height="16"/></span>
            <input type="text" class="form-control" id="Username" placeholder="Username" aria-label="Username"
                aria-describedby="basic-addon1" wire:model.defer="state.username" />
                <div class="col-sm-12"><x-jet-input-error for="username" class="text-danger" /></div>
        </div>

        <!-- Email -->
        <div class="input-group">
            <div class="col-sm-12 mt-1">{{ __('Username') }}</div>
            <span class="input-group-text" id="basic-addon1"><img
                src="https://img.icons8.com/external-kiranshastry-lineal-color-kiranshastry/64/000000/external-email-cyber-security-kiranshastry-lineal-color-kiranshastry-1.png" width="16" height="16" /></span>
            <input type="email" class="form-control" placeholder="Email" aria-label="Email"
                aria-describedby="basic-addon1" wire:model.defer="state.email" />
                <div class="col-sm-12"><x-jet-input-error for="email" class="text-danger" /></div>
        </div>

        <!-- Phone Number -->
        <div class="input-group">
            <div class="col-sm-12 mt-1">{{ __('Phone Number') }}</div>
            <span class="input-group-text" id="basic-addon1"><img
                src="https://img.icons8.com/external-justicon-lineal-color-justicon/64/000000/external-phone-hotel-essentials-justicon-lineal-color-justicon.png" width="16" height="16" /></span>
            <input type="text" class="form-control" placeholder="Phone Number" aria-label="Phone Number"
                aria-describedby="basic-addon1" wire:model.defer="state.phone_no" />
                <div class="col-sm-12"><x-jet-input-error for="phone_no" class="text-danger" /></div>
        </div>

        <!-- Social Media Link -->
        <div class="input-group">
            <div class="col-sm-12 mt-1">{{ __('Social Media') }}</div>
            <span class="input-group-text" id="basic-addon1"><img src="https://img.icons8.com/small/16/000000/facebook-new.png" /></span>
            <input type="text" class="form-control" placeholder="Social Media" aria-label="social_media"
                aria-describedby="basic-addon1" wire:model.defer="state.social_media" />
                <div class="col-sm-12"><x-jet-input-error for="social_media" class="text-danger" /></div>
        </div>

        <!-- User Short Biography -->
        <div class="input-group">
            <div class="col-sm-12 mt-1">{{ __('Biography') }}</div>
            <textarea class="form-control" aria-label="With textarea" wire:model.defer="state.bio"></textarea>
            <div class="col-sm-12"><x-jet-input-error for="bio" class="text-danger" />
            </div>
        </div>
        </div>
    </div>
    </x-slot>
        </div>
    </div>

    <x-slot name="actions" class="col-md-12 bg-primary">
        <x-jet-action-message class="text-success mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <button wire:loading.attr="disabled" wire:target="photo" class="btn btn-primary btn-lg p-1" style="width: 300px">
            {{ __('Save Profile Information') }}
        </button>
    </x-slot>
</x-jet-form-section>
