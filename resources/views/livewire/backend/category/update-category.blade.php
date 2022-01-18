<div wire:ignore.self class="modal fade" id="updateCategoryModal" tabindex="1" aria-labelledby="updateCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Update Category</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click.prevent="cancel()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                @csrf
                    <div class="col-12">
                        <label for="name" class="col-form-label">Category Name (<span class="text-danger">*</span>):</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" wire:model="name" value="{{old('name')}}" wire:keyup="generateSlug()" required>
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <label for="slug" class="col-form-label">Category Slug (<span class="text-danger">*</span>):</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" wire:model="slug" value="{{old('slug')}}" required>
                        @error('slug') <span class="text-danger error">{{ $message }}</span>@enderror
                        @if ($data['checkSlug'] > 0)
                        <span class="text-danger">Category Slug Not Available</span>
                        @else
                        @if ($data['checkEmpty'] == 0)
                        @else
                        <span class="text-success">Category Slug Available</span>
                        @endif
                        @endif
                    </div>
                    <div class="col-12">
                        <label for="image3" class="col-form-label">Category Image ( Optional ):</label>
                        <input type="file" class="form-control @error('image3') is-invalid @enderror" name="image3" accept="image/*" id="image3" wire:model="image3" onchange="return checkImageExtention3()">
                        @error('image3') <span class="text-danger error">{{ $message }}</span>@enderror
                        <div wire:loading wire:target="image3" class="text-success">Uploading...</div>
                        <div id="error-msg3" class="text-danger"></div>
                        <div class="row">
                        @if($image2)
                        <div class="col-6 text-center w-50">
                            Current Image: <br><img src="{{ $image2 }}" style="width: 100px; height:80px;">
                        </div>
                        @else
                        @endif
                        @if ($image3)
                        <div class="col-6 text-center w-50">
                           Selected New Image: <br><img src="{{ $image3->temporaryUrl() }}" style="width: 100px; height:80px;">
                        </div>
                        @endif
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="Parent_id" class="col-form-label">Select Parent Category (<span class="text-danger">*</span>):</label>
                            <select type="text" class="form-control @error('parent_id') is-invalid @enderror" name="parent_id" wire:model="parent_id">
                                <option value="">None</option>
                                    @if($data['catOption'])
                                        @foreach($data['catOption'] as $category)
                                            <?php $dash=''; ?>
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @if(count($category->subcategory))
                                                @include('backend.category.subCategoryList-option', ['subcategories' => $category->subcategory])
                                            @endif
                                        @endforeach
                                    @endif
                            </select>
                            @error('parent_id') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" wire:click.prevent="updateCategory()" style="padding: 14px; margin-bottom:10px">Update Category</button>
            </div>
        </div>
    </div>
</div>
