<div wire:ignore.self class="modal fade" id="addCategoryModal" tabindex="1" aria-labelledby="addCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add New Category</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div>
                        <label for="name" class="col-form-label">Category Name (<span class="text-danger">*</span>):</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name" value="{{old('name')}}" required>
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="slug" class="col-form-label">Category Slug (<span class="text-danger">*</span>):</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" wire:model="slug" value="{{old('slug')}}" required>
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
                    <div>
                        <label for="image" class="col-form-label">Category Image ( Optional ):</label>
                        <input type="file" class="form-control" name="image" id="image" wire:model="image">
                        @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="Parent_id" class="col-form-label">Select Parent Category (<span class="text-danger">*</span>):</label>
                            <select type="text" name="parent_id" class="form-control" wire:model="parent_id">
                                <option value="" selected>None</option>
                                @if($data['categories'])
                                    @foreach($data['categories'] as $category)
                                        <?php $dash=''; ?>
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @if(count($category->subcategory))
                                            @include('backend.category.subCategoryList-option',['subcategories' => $category->subcategory])
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" wire:click.prevent="storeCategory()" style="padding: 14px">Add New Category</button>
            </div>
        </div>
    </div>
</div>
