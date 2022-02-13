<div wire:ignore.self class="modal fade w-100" id="TagModal" tabindex="-1" aria-labelledby="TagModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="padding: 0px; margin:0px; border-bottom:2px solid rgb(231, 231, 231)">
            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 ps-1">
                <h2 class="modal-title" id="exampleModalLabel">@if ($updateMode) Update Tag @else Add New Tag @endif</h2>
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
                @csrf
                <div class="row">
                            <div class="col-md-12 align-items-center h-100">
                                <div>
                                    <label for="title" class="col-form-label">Title (<span class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" wire:model="title" wire:keyup="generateSlug()" wire:change="generateSlug()" required />
                                    @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label for="slug" class="col-form-label">Slug (<span class="text-danger">*</span>):</label>
                                    <input type="text" class="form-control @if($checkingMode) @if ($data['checkslug'] > 0) is-invalid @endif @endif @error('slug') is-invalid @enderror" id="slug" wire:keyup="checkSlug()" wire:model="slug" />
                                    @error('slug') <span class="text-danger error">{{ $message }}</span>@enderror
                                    @if($checkingMode)
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
                                    <label for="meta_description" class="col-form-label">Meta Description ( Optional ):</label>
                                    <textarea class="form-control" id="meta_description" wire:model="meta_description"></textarea>
                                    @error('meta_description') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 p-1 w-100 text-center">
                    @if ($updateMode)
                    <button class="btn btn-primary btn-lg" wire:click.prevent="updateTag({{ $tag_id }})">Update Tag</button>
                    @else
                    <button class="btn btn-primary btn-lg" wire:click.prevent="storeTag()">Add New Tag</button>
                    @endif
                    </div>
                </div>
            </div>
        </div>

