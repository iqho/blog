<div wire:ignore.self class="modal fade w-100" role="dialog" id="updateMediaModal" role="dialog" tabindex="-1" aria-labelledby="updateMediaModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-xl" style="max-width: 75%; margin: 3rem auto;">
            <div class="modal-content">
                <div class="modal-header" style="padding: 0px; margin:0px; border-bottom:2px solid rgb(231, 231, 231)">
                    <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 ps-1">
                        <h2 class="modal-title" id="exampleModalLabel">@if ($updateMode) Edit Media Details @else Media Details @endif</h2>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-end g-0">
                        <div class="btn-group flex-wrap m-0" role="group"
                            style="border-left:2px solid rgb(231, 231, 231)">
                            @if($updateMode)
                            @if($preBtn) <button type="button" wire:click.prevent="edit({{ $preBtn->id }})" class="btn btn-link m-0"><i class="fa fa-chevron-left fa-2x"></i></button> @endif
                            @if($nextBtn) <button type="button" wire:click.prevent="edit({{ $nextBtn->id }})" class="btn btn-link m-0"><i class="fa fa-chevron-right fa-2x"></i></button> @endif
                            @else
                            @if($preBtn) <button type="button" wire:click.prevent="details({{ $preBtn->id }})" class="btn btn-link m-0"><i class="fa fa-chevron-left fa-2x"></i></button> @endif
                            @if($nextBtn) <button type="button" wire:click.prevent="details({{ $nextBtn->id }})" class="btn btn-link m-0"><i class="fa fa-chevron-right fa-2x"></i></button> @endif
                            @endif
                            <button type="button" class="btn btn-link m-0" wire:click.prevent="cancel()"
                                data-bs-dismiss="modal"><i class="fas fa-times fa-2x"></i></button>
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

                    <form id="updateForm" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-6 text-center align-middle">
                                <div class="col-12 text-center w-100">
                                    @if ($media_name3)
                                    <img src="{{ $media_name3->temporaryUrl() }}" style="max-height: 300px" class="img-fluid img-thumbnail rounded">
                                    @else
                                    @if ($media_name2)
                                    <img src="{{ asset('storage/media/'.$media_name2) }}" style="max-height: 300px" class="img-fluid img-thumbnail rounded">
                                    @else
                                    <img src="{{ asset('images/no-image-available.jpg') }}" style="max-height: 300px" class="img-fluid img-thumbnail rounded">
                                    @endif

                                    @endif
                                </div>
                                @if ($updateMode)
                                <div wire:loading wire:target="media_name3" class="text-success">Uploading...</div>
                                <input type="file" class="form-control" style="max-width: 75%; margin: 8px auto;" name="media_name3"
                                    onchange="return checkImageExtentionupdate()" id="media_name3" wire:model="media_name3" required />
                                <div id="error-msg3" class="text-danger"></div>
                                @endif

                                <div class="col-12">
                                    <div class="col-12 d-flex justify-content-center w-100">
                                        <div class="text-start">
                                            @if($media_name3)
                                            <div class="col-12 h3 mt-1">Image Details</div>
                                            <b>Image Name:</b> {{ pathinfo($media_name3->getClientOriginalName(),
                                            PATHINFO_FILENAME) }}<br>
                                            <b>Size:</b> {{ formatSizeUnits($media_name3->getSize()) }}<br>
                                            <b>Extension:</b> {{ $media_name3->extension() }} <br>
                                            <b>Full Image Name:</b> {{ $media_name3->getClientOriginalName() }}
                                            @else
                                            @if ($media_name2)
                                            <div class="col-12 h3 mt-1">Image Details</div>
                                            @php
                                            $path = asset('storage/media/'.$media_name2);
                                            $pathinfo = pathinfo($path);
                                            @endphp
                                            <b>Image Name:</b> {{ $pathinfo['filename'] }}<br>
                                            <b>Size:</b> {{ formatSizeUnits($mediaSize) }}<br>
                                            <b>Extension:</b> {{ $pathinfo['extension'] }} <br>
                                            <b>Full Image Name:</b> {{ basename($path) }}
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 align-items-center h-100">
                                <label for="mediaURL" class="col-form-label">Media URL:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="mediaURL2" value="{{ $mediaURL }}"
                                        readonly>
                                    <span class="input-group-text"><a href="javascript:void(0)" class="copy-btn" tooltip="Copied"
                                            data-clipboard-target="#mediaURL2">Copy</a></span>
                                </div>
                                <div>
                                    <label for="title" class="col-form-label">Title (<span
                                            class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" wire:model="title" wire:keyup="generateSlug()"
                                        wire:change="generateSlug()" @if (!$updateMode) readonly @endif required>
                                    @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="slug" class="col-form-label">Slug (<span
                                            class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @if ($checkMode) @if ($data['checkslug'] > 0) is-invalid @endif @endif @error('slug') is-invalid @enderror"
                                        id="slug" wire:model="slug" @if (!$updateMode) readonly @endif required>
                                    @error('slug') <span class="text-danger error">{{ $message }}</span>@enderror
                                    @if ($checkMode)
                                    @if ($data['checkslug'] > 0)
                                    <span class="text-danger">Not Available</span>
                                    @else
                                    @if ($data['checkEmpty'] == 0)
                                    @else
                                    <span class="text-success">Slug Available</span>
                                    @endif
                                    @endif
                                    @endif

                                </div>
                                <div>
                                    <label for="caption" class="col-form-label">Caption (<span
                                            class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @error('caption') is-invalid @enderror"
                                        id="caption" wire:model="caption" @if (!$updateMode) readonly @endif >
                                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="alt" class="col-form-label">Alternative Text (<span
                                            class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control" id="alt" wire:model="alt" @if (!$updateMode) readonly @endif>
                                    @error('alt') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="media_type" class="col-form-label">Media Type (<span
                                            class="text-danger">*</span>):</label>
                                    <select class="form-select @error('media_type') is-invalid @enderror"
                                        aria-label="media_type" wire:model="media_type" required @if (!$updateMode) disabled @endif>
                                        <option value="" selected>Select Media Type</option>
                                        <option value="images">Image</option>
                                        <option value="videos">Video</option>
                                        <option value="others">Others</option>
                                    </select>
                                    @error('media_type') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="description" class="col-form-label">Description ( Optional ):</label>
                                    <textarea class="form-control" id="description" wire:model="description" @if (!$updateMode) readonly @endif></textarea>
                                    @error('description') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="col-12 w-100 text-center">
                    @if ($updateMode)
                    <button type="button" class="btn btn-warning me-2" wire:click="details({{ $media_id }})" style="padding: 14px">Back to Details Mode</button>
                    <button type="button" class="btn btn-success me-2" wire:click="updateMedia({{ $media_id }})" style="padding: 14px">Update Media</button>
                    <button type="button" class="btn btn-danger me-2" onclick="confirm('Confirm ! You Want to Move This Media to Trashed ?') || event.stopImmediatePropagation()" wire:click="trashed({{ $media_id }})" style="padding: 14px">Move to Trashed</button>
                    <button type="button" class="btn btn-danger me-2" onclick="confirm('Confirm ! You Want to Delete This Media Parmanently ?') || event.stopImmediatePropagation()" wire:click="parmanentDelete({{ $media_id }})" style="padding: 14px">Delete Parmanently</button>
                    @else
                    <button type="button" class="btn btn-primary me-2" wire:click="edit({{ $media_id }})" style="padding: 14px">Edit Media Details</button>
                    <button type="button" class="btn btn-danger me-2" onclick="confirm('Confirm ! You Want to Move This Media to Trashed ?') || event.stopImmediatePropagation()" wire:click="trashed({{ $media_id }})" style="padding: 14px">Move to Trashed</button>
                    <button type="button" class="btn btn-danger me-2" onclick="confirm('Confirm ! You Want to Delete This Media Parmanently ?') || event.stopImmediatePropagation()" wire:click="parmanentDelete({{ $media_id }})" style="padding: 14px">Delete Parmanently</button>
                    @endif
                </div>
                </div>
            </div>
        </div>
    </div>
