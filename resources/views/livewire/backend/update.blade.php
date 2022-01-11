<div wire:ignore.self class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Update User Details</h2>
                <button type="button" class="btn-close" wire:click.prevent="cancel()" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateform">
                    <div>
                        <label for="name" class="col-form-label">Full Name (<span class="text-danger">*</span>):</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name">
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="userName" class="col-form-label">Username (<span class="text-danger">*</span>):</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="userName" wire:model="username">
                        @error('username') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="email" class="col-form-label">Email (<span class="text-danger">*</span>):</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" wire:model="email">
                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="userPassword" class="col-form-label">Password ( If want to Change ):</label>
                        <input type="text" style="-webkit-text-security: circle;" class="form-control @error('password') is-invalid @enderror" id="userPassword"
                            wire:model="password">
                        @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="phone_no" class="col-form-label">Phone Number ( Optional ):</label>
                        <input type="text" class="form-control" id="phone_no" wire:model="phone_no">
                        @error('phone_no') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="social_media" class="col-form-label">Social Media ( Optional ):</label>
                        <input type="text" class="form-control" id="social_media" wire:model="social_media">
                        @error('social_media') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="UserType" class="col-form-label">User Type (<span class="text-danger">*</span>):</label>
                        <select class="form-select @error('user_type') is-invalid @enderror" aria-label="UserType" wire:model="user_type">
                            <option value="0">Subscriber</option>
                            <option value="1">Admin</option>
                            <option value="2">Editor</option>
                            <option value="3">Author</option>
                            <option value="4">Contributor</option>
                        </select>
                        @error('user_type') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="bio" class="col-form-label">Biography ( Optional ):</label>
                        <textarea class="form-control" id="bio" wire:model="bio"></textarea>
                        @error('bio') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" wire:click.prevent="updateUser()" style="padding: 14px">Update Users Details</button>
            </div>
        </div>
    </div>
</div>
