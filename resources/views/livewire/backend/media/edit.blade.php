<div wire:ignore.self class="modal fade w-100" id="updateMediaModal" tabindex="1" aria-labelledby="updateMediaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" style="max-width: 75%; margin: 3rem auto;">
            <div class="modal-content">
                <div class="modal-header" style="padding: 0px; margin:0px; border-bottom:2px solid rgb(231, 231, 231)">
                    <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 ps-1">
                        <h2 class="modal-title" id="exampleModalLabel">Update Media</h2>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-end g-0">
                        <div class="btn-group flex-wrap m-0" role="group"
                            style="border-left:2px solid rgb(231, 231, 231)">
                            <button type="button" class="btn btn-link m-0"><i
                                    class="fa fa-chevron-left fa-2x"></i></button>
                            <button type="button" class="btn btn-link m-0"><i
                                    class="fa fa-chevron-right fa-2x"></i></button>
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

                    <form id="updateform" method="" action="" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-6 text-center align-middle">
                                @if($media_name3)
                                <div class="col-12 text-center w-100">
                                    @if ($media_name2)
                                    <img src="{{ asset('storage/media/'.$media_name2) }}" style="max-height: 300px"
                                        class="img-fluid img-thumbnail rounded">
                                    @else
                                    <img src="{{ $media_name3->temporaryUrl() }}" style="max-height: 300px"
                                        class="img-fluid img-thumbnail rounded">
                                    @endif
                                </div>
                                @else
                                <div class="col-12 text-center w-100">
                                    <img src="{{ asset('backend/assets/images/slider/03.jpg') }}"
                                        style="max-height: 300px" class="img-fluid img-thumbnail rounded">
                                </div>
                                @endif
                                <div wire:loading wire:target="media_name3" class="text-success">Uploading...</div>
                                <input type="file" class="form-control" name="media_name3"
                                    onchange="return checkImageExtention()" id="media_name3" wire:model="media_name3" required />
                                <div id="error-msg" class="text-danger"></div>
                                <div class="col-12">
                                    <div class="col-12 d-flex justify-content-center w-100">
                                        <div class="text-start">
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
                                            @else
                                            @if($media_name3)
                                            <div class="col-12 h3 mt-1">Image Details</div>
                                            <b>Image Name:</b> {{ pathinfo($media_name3->getClientOriginalName(),
                                            PATHINFO_FILENAME) }}<br>
                                            <b>Size:</b> {{ formatSizeUnits($media_name3->getSize()) }}<br>
                                            <b>Extension:</b> {{ $media_name3->extension() }} <br>
                                            <b>Full Image Name:</b> {{ $media_name3->getClientOriginalName() }}
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 align-items-center h-100">
                                <label for="mediaURL" class="col-form-label">Media URL:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="mediaURL" value="{{ $mediaURL }}"
                                        readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success copy-btn"
                                            data-clipboard-target="#mediaURL" type="button">Copy</button>
                                    </div>
                                </div>
                                <div id="copy-msg" class="text-success ps-1"></div>
                                <div>
                                    <label for="title" class="col-form-label">Title (<span
                                            class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" wire:model="title" wire:keyup="generateSlug()"
                                        wire:change="generateSlug()" required>
                                    @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="slug" class="col-form-label">Slug (<span
                                            class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" wire:model="slug">
                                    @error('slug') <span class="text-danger error">{{ $message }}</span>@enderror 
                                    @if ($data['checkslug'] > 0)
                                    <span class="text-danger"><i class="fas fa-sign-language    "></i> Not
                                        Available</span>
                                    @else
                                    @if ($data['checkEmpty'] == 0)
                                    @else
                                    <span class="text-success">Slug Available</span>
                                    @endif
                                    @endif

                                </div>
                                <div>
                                    <label for="caption" class="col-form-label">Caption (<span
                                            class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @error('caption') is-invalid @enderror"
                                        id="caption" wire:model="caption">
                                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="alt" class="col-form-label">Alternative Text (<span
                                            class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control" id="alt" wire:model="alt">
                                    @error('alt') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="media_type" class="col-form-label">Media Type (<span
                                            class="text-danger">*</span>):</label>
                                    <select class="form-select @error('media_type') is-invalid @enderror"
                                        aria-label="media_type" wire:model="media_type" required>
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
                    <button type="button" class="btn btn-primary" wire:click.prevent="updateMedia()"
                        style="padding: 14px">Update Media</button>
                </div>
            </div>
        </div>
    </div>