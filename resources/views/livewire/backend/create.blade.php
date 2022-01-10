<div wire:ignore.self class="modal fade" id="addUserModal" tabindex="1" aria-labelledby="addUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add New User</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateform">
                    <div>
                        <label for="name" class="col-form-label">Full Name(*):</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name">
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="username" class="col-form-label">Username(*):</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" wire:model="username">
                        @error('username') <span class="text-danger error">{{ $message }}</span>@enderror                                       
                        @if ($data['checkUser'] > 0)
                        <span class="text-danger">Username Not Available</span>
                        @else
                        @if ($data['checkEmpty'] == 0)
                        @else
                        <span class="text-success">Username Available</span>        
                        @endif
                        @endif
                    </div>
                    <div>
                        <label for="email" class="col-form-label">*Email(*):</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model="email">
                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                        @if ($data['checkValidEmail'] > 0)
                        @if ($data['checkEmail'] > 0)
                        <span class="text-danger">Already Registered using This Email Address</span>
                        @else
                        @if ($data['checkEmailEmpty'] == 0)
                        @else
                        <span class="text-success">Email Address is Usable</span>
                        @endif
                        @endif
                        @else
                        @if ($data['checkEmailEmpty'] == 0)
                        @else
                        <span class="text-danger">Invalid Email Address</span>
                        @endif
                        @endif
                    </div>
                    <div>
                        <label for="userPassword" class="col-form-label">Password(*):</label>
                        <input type="text" style="-webkit-text-security: circle;" class="form-control @error('password') is-invalid @enderror" id="userPassword" wire:model="password">
                        @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="phone_no" class="col-form-label">Phone Number (Optional):</label>
                        <input type="text" class="form-control" id="phone_no" wire:model="phone_no">
                        @error('phone_no') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="social_media" class="col-form-label">Social Media (Optional):</label>
                        <input type="text" class="form-control" id="social_media" wire:model="social_media">
                        @error('social_media') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="UserType" class="col-form-label">*User Type:</label>
                        <select class="form-select @error('user_type') is-invalid @enderror" aria-label="UserType" wire:model="user_type">
                            <option selected>Please Select User Type</option>
                            <option value="0">Subscriber</option>
                            <option value="1">Admin</option>
                            <option value="2">Editor</option>
                            <option value="3">Author</option>
                            <option value="4">Contributor</option>
                        </select>
                        @error('user_type') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="bio" class="col-form-label">Biography (Optional):</label>
                        <textarea class="form-control" id="bio" wire:model="bio"></textarea>
                        @error('bio') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" wire:click.prevent="storeUser()">Add New User</button>
            </div>
        </div>
    </div>
</div>