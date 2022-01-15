<div wire:ignore.self class="modal fade" id="updateCategoryModal" tabindex="1" aria-labelledby="addCategoryModalLabel"
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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name">
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="slug" class="col-form-label">Category Slug (<span class="text-danger">*</span>):</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" wire:model="slug">
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
                        <label for="image" class="col-form-label">Social Media ( Optional ):</label>
                        <input type="file" class="form-control" id="image" wire:model="image">
                        @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="Parent_id" class="col-form-label">Select Parent Category (<span class="text-danger">*</span>):</label>
                            <select type="text" name="parent_id" class="form-control">
                                <option value="">None</option>
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

                    <div>
                        <label for="Parent_id" class="col-form-label">Main Category (<span class="text-danger">*</span>):</label>
                        <select class="form-select @error('parent_id') is-invalid @enderror" aria-label="Parent_id" wire:model="parent_id">
                            <option selected>Please </option>
                            <option value="0">Subscriber</option>
                            <option value="1">Admin</option>
                            <option value="2">Editor</option>
                            <option value="3">Author</option>
                            <option value="4">Contributor</option>
                        </select>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Select parent category*</label>
                                <select type="text" name="parent_id" class="form-control">
                                    <option value="">None</option>
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
                <button type="button" class="btn btn-primary" wire:click.prevent="storeUser()" style="padding: 14px">Add New User</button>
            </div>
        </div>
    </div>
</div>
