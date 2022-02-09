<div wire:ignore.self class="modal fade w-100" id="addMediaModal" tabindex="-1" aria-labelledby="addUserModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-xl" style="max-width: 75%; margin: 3rem auto;">
    <div class="modal-content">
        <div class="modal-header" style="padding: 0px; margin:0px; border-bottom:2px solid rgb(231, 231, 231)">
            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 ps-1">
                <h2 class="modal-title" id="exampleModalLabel">Add New Media</h2>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-end g-0">
                <div class="btn-group flex-wrap m-0" role="group" style="border-left:2px solid rgb(231, 231, 231)">
                    <button type="button" class="btn btn-link m-0" wire:click.prevent="cancel()" data-bs-dismiss="modal"><i class="fas fa-times fa-2x"></i></button>
                </div>
            </div>

        </div>
        <div class="modal-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-6 text-center align-middle">
                        @if($media_name)
                        <div class="col-12 text-center w-100">
                            <img src="{{ $media_name->temporaryUrl() }}" style="max-height: 300px" class="img-fluid img-thumbnail rounded" >
                        </div>
                        @else
                        <div class="col-12 text-center w-100">
                            <img src="{{ asset('images/no-image-available.jpg') }}" style="max-height: 300px" class="img-fluid img-thumbnail rounded mb-1">
                        </div>
                        @endif
                            <div wire:loading wire:target="media_name" class="text-success">Uploading...</div>
                            <input type="file" class="form-control" name="media_name" onchange="return checkImageExtention()" id="media_name" wire:model="media_name" wire:change="generateTitle()" required/>
                            <div wire:ignore id="error-msg" class="text-danger"></div>
                            <div class="col-12">
                                <div class="col-12 d-flex justify-content-center w-100">
                                    <div class="text-start">
                                        @if($media_name)
                                      <div class="col-12 h3 mt-1">Image Details</div>
                                        <b>Image Name:</b> {{ pathinfo($media_name->getClientOriginalName(), PATHINFO_FILENAME) }}<br>
                                        <b>Size:</b>  {{ formatSizeUnits($media_name->getSize()) }}<br>
                                        <b>Extension:</b>  {{ $media_name->extension() }} <br>
                                        <b>Full Image Name:</b>  {{ $media_name->getClientOriginalName() }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-md-6 align-items-center h-100">
                                <div>
                                    <label for="title" class="col-form-label">Title (<span class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" wire:model="title" wire:keyup="generateSlug()" wire:change="generateSlug()" required />
                                    @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="slug" class="col-form-label">Slug (<span class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @if ($data['checkslug'] > 0) is-invalid @endif @error('slug') is-invalid @enderror" id="slug" wire:model="slug" />
                                    @error('slug') <span class="text-danger error">{{ $message }}</span>@enderror
                                    @if ($data['checkslug'] > 0)
                                    <span class="text-danger">Not Available</span>
                                    @else
                                    @if ($data['checkEmpty'] == 0)
                                    @else
                                    <span class="text-success">Slug Available</span>
                                    @endif
                                    @endif
                                </div>
                                <div>
                                    <label for="caption" class="col-form-label">Caption (<span class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @error('caption') is-invalid @enderror" id="caption" wire:model="caption">
                                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="alt" class="col-form-label">Alternative Text (<span class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control" id="alt" wire:model="alt" />
                                    @error('alt') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="media_type" class="col-form-label">Media Type (<span class="text-danger">*</span>):</label>
                                    <select class="form-select @error('media_type') is-invalid @enderror" aria-label="media_type" wire:model="media_type" required>
                                        <option value="" selected>Select Media Type</option>
                                        <option value="images">Image</option>
                                        <option value="videos">Video</option>
                                        <option value="others">Others</option>
                                    </select>
                                    @error('media_type') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="description" class="col-form-label">Description ( Optional ):</label>
                                    <textarea class="form-control" id="description" wire:model="description"></textarea>
                                    @error('description') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary me-1" wire:click.prevent="storeMedia()" style="padding: 14px">Add
                    New Media</button>
                    </div>
                </div>
            </div>
        </div>

