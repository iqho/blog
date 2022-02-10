<div wire:ignore.self class="modal fade w-100" role="dialog" id="detailsTrashedMediaModal" role="dialog" tabindex="-1" aria-labelledby="updateMediaModalLabel"
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
                            @if($preBtn) <button type="button" wire:click.prevent="details({{ $preBtn->id }})" class="btn btn-link m-0"><i class="fa fa-chevron-left fa-2x"></i></button> @endif
                            @if($nextBtn) <button type="button" wire:click.prevent="details({{ $nextBtn->id }})" class="btn btn-link m-0"><i class="fa fa-chevron-right fa-2x"></i></button> @endif
                            <button type="button" class="btn btn-link m-0" wire:click.prevent="cancel()"
                                data-bs-dismiss="modal"><i class="fas fa-times fa-2x"></i></button>
                        </div>
                    </div>

                </div>
                <div class="modal-body">
                    <form id="updateForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 text-center align-middle">
                                <div class="col-12 text-center w-100">
                                    @if ($media_name2)
                                    <img src="{{ asset('storage/media/'.$media_name2) }}" style="max-height: 300px" class="img-fluid img-thumbnail rounded">
                                    @else
                                    <img src="{{ asset('images/no-image-available.jpg') }}" style="max-height: 300px" class="img-fluid img-thumbnail rounded">
                                    @endif
                                </div>
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
                                    <input type="text" class="form-control" id="title" wire:model="title" readonly>
                                </div>
                                <div>
                                    <label for="slug" class="col-form-label">Slug (<span
                                            class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control" id="slug" wire:model="slug" readonly >
                                </div>
                                <div>
                                    <label for="caption" class="col-form-label">Caption (<span
                                            class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control" id="caption" wire:model="caption" readonly >
                                </div>
                                <div>
                                    <label for="alt" class="col-form-label">Alternative Text (<span
                                            class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control" id="alt" wire:model="alt" readonly>
                                </div>
                                <div>
                                    <label for="media_type" class="col-form-label">Media Type (<span
                                            class="text-danger">*</span>):</label>
                                    <select class="form-select" aria-label="media_type" wire:model="media_type" disabled>
                                        <option value="images">Image</option>
                                        <option value="videos">Video</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="description" class="col-form-label">Description ( Optional ):</label>
                                    <textarea class="form-control" id="description" wire:model="description" readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer g-0 mt-1">
                        <div class="col-12 w-100 text-center ">
                        <button type="button" class="btn btn-success m-0" wire:click.prevent="cancel()"
                        data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
