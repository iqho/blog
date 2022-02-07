@php
function formatSizeUnits($bytes)
{
$label = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
for ( $i = 0; $bytes >= 1024 && $i < ( count( $label ) -1 ); $bytes /=1024, $i++ );
return ( round( $bytes, 2 ) . " " . $label[$i] );
}

function getFilesize($file, $digits = 2) {
       if (is_file($file)) {
               $filePath = $file;
               if (!realpath($filePath)) {
                       $filePath = $_SERVER["DOCUMENT_ROOT"].$filePath;
       }
           $fileSize = filesize($filePath);
               $sizes = array("TB","GB","MB","KB","B");
               $total = count($sizes);
               while ($total-- && $fileSize > 1024) {
                       $fileSize /= 1024;
                       }
               return round($fileSize, $digits)." ".$sizes[$total];
       }
       return false;
}
@endphp

<div wire:ignore.self class="modal fade w-100" id="addMediaModal" tabindex="1" aria-labelledby="addUserModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-xl" style="max-width: 75%; margin: 3rem auto;">
    <div class="modal-content">
        <div class="modal-header" style="padding: 0px; margin:0px; border-bottom:2px solid rgb(231, 231, 231)">
            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 ps-1">
                <h2 class="modal-title" id="exampleModalLabel">Add New Media</h2>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-end g-0">
                <div class="btn-group flex-wrap m-0" role="group" style="border-left:2px solid rgb(231, 231, 231)">
                    <button type="button" class="btn btn-link m-0"><i class="fa fa-chevron-left fa-2x"></i></button>
                    <button type="button" class="btn btn-link m-0"><i class="fa fa-chevron-right fa-2x"></i></button>
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

            <form id="updateform" method="" action="" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-6 text-center align-middle">
                        @if($media_name)
                        <div class="col-12 text-center w-100">
                            @if ($viewMode)
                            <img src="{{ asset('storage/media/'.$media_name) }}" style="max-height: 300px" class="img-fluid img-thumbnail rounded">
                            @elseif ($updateMode)
                            <img src="{{ asset('storage/media/'.$media_name) }}" style="max-height: 300px" class="img-fluid img-thumbnail rounded">
                            @else
                            <img src="{{ $media_name->temporaryUrl() }}" style="max-height: 300px" class="img-fluid img-thumbnail rounded" >
                            @endif
                        </div>
                        @else
                        <div class="col-12 text-center w-100">
                            <img src="{{ asset('backend/assets/images/slider/03.jpg') }}" style="max-height: 300px" class="img-fluid img-thumbnail rounded">
                        </div>
                        @endif
                            <div wire:loading wire:target="media_name" class="text-success">Uploading...</div>

                            @if($updateMode)
                            <input type="file" class="form-control" name="media_name" onchange="return checkImageExtention()" id="media_name" wire:model="media_name" wire:change="generateTitle()" required/>
                            <div id="error-msg" class="text-danger"></div>
                            @elseif ($viewMode)
                            @else
                            <input type="file" class="form-control" name="media_name" onchange="return checkImageExtention()" id="media_name"
                                wire:model="media_name" wire:change="generateTitle()" required />
                            <div id="error-msg" class="text-danger"></div>
                            @endif
                            <div class="col-12">
                                <div class="col-12 d-flex justify-content-center w-100">
                                    <div class="text-start">
                                        @if ($viewMode)
                                        <div class="col-12 h3 mt-1">Image Details</div>
                                        @php
                                        $path = asset('storage/media/'.$media_name);
                                        $pathinfo = pathinfo($path);
                                        @endphp
                                        <b>Image Name:</b> {{ $pathinfo['filename'] }}<br>
                                        <b>Size:</b>  {{ formatSizeUnits($mediaSize) }}<br>
                                        <b>Extension:</b>  {{ $pathinfo['extension'] }} <br>
                                        <b>Full Image Name:</b>  {{ basename($path) }}
                                       
                                             <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal"  data-bs-target="#updateMediaModal" id="editbtn" wire:click="edit({{ $media_id }})">Edit Media</a>
                                             
                                       

                                        @else
                                        @if($media_name)
                                        {{-- <div class="col-12 h3 mt-1">Image Details</div>
                                        <b>Image Name:</b> {{ pathinfo($media_name->getClientOriginalName(), PATHINFO_FILENAME) }}<br>
                                        <b>Size:</b>  {{ formatSizeUnits($media_name->getSize()) }}<br>
                                        <b>Extension:</b>  {{ $media_name->extension() }} <br>
                                        <b>Full Image Name:</b>  {{ $media_name->getClientOriginalName() }} --}}
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-md-6 align-items-center h-100">
                                @if ($viewMode)
                                <label for="mediaURL" class="col-form-label">Media URL:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="mediaURL" value="{{ $mediaURL }}" readonly>
                                    <span class="input-group-text"><a href="javascript:void(0)" class="copy-btn" tooltip="Copied" data-clipboard-target="#mediaURL">Copy</a></span>
                                </div>
                                @endif
                                <div>
                                    <label for="title" class="col-form-label">Title (<span class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" wire:model="title" wire:keyup="generateSlug()" wire:change="generateSlug()" required @if($viewMode) readonly @endif>
                                    @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="slug" class="col-form-label">Slug (<span class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" wire:model="slug" @if($viewMode) readonly @endif>
                                    @error('slug') <span class="text-danger error">{{ $message }}</span>@enderror
                                    @if (!$viewMode)
                                    @if ($data['checkslug'] > 0)
                                    <span class="text-danger"><i class="fas fa-sign-language    "></i> Not Available</span>
                                    @else
                                    @if ($data['checkEmpty'] == 0)
                                    @else
                                    <span class="text-success">Slug Available</span>
                                    @endif
                                    @endif
                                    @endif

                                </div>
                                <div>
                                    <label for="caption" class="col-form-label">Caption (<span class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @error('caption') is-invalid @enderror" id="caption" wire:model="caption" @if($viewMode) readonly @endif>
                                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="alt" class="col-form-label">Alternative Text (<span class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control" id="alt" wire:model="alt" @if($viewMode) readonly @endif>
                                    @error('alt') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="media_type" class="col-form-label">Media Type (<span class="text-danger">*</span>):</label>
                                    <select class="form-select @error('media_type') is-invalid @enderror" aria-label="media_type" wire:model="media_type" required @if($viewMode) disabled @endif>
                                        <option value="" selected>Select Media Type</option>
                                        <option value="images">Image</option>
                                        <option value="videos">Video</option>
                                        <option value="others">Others</option>
                                    </select>
                                    @error('media_type') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="description" class="col-form-label">Description ( Optional ):</label>
                                    <textarea class="form-control" id="description" wire:model="description" @if($viewMode) readonly @endif></textarea>
                                    @error('description') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    @if ($viewMode)
                    <div class="col-12 d-flex justify-content-center w-100">
                    <button type="button" class="btn btn-primary  m-0" wire:click.prevent="cancel()" data-bs-dismiss="modal">Close Modal</button>
                    </div>
                    @else
                    <button type="button" class="btn btn-primary" wire:click.prevent="storeMedia()" style="padding: 14px">Add
                    New Media</button>
                    @endif

                    </div>
                </div>
            </div>
        </div>

