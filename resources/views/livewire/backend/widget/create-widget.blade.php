<div wire:ignore.self class="modal fade" id="addWidgetModal" tabindex="1" aria-labelledby="addWidgetModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if ($updateMode)
                <h2 class="modal-title" id="exampleModalLabel">Update Widget</h2>
                @else
                <h2 class="modal-title" id="exampleModalLabel">Add New Widget</h2>                   
                @endif

                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click.prevent="cancel()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
                @csrf
                @if ($updateMode)
                   <input type="hidden" wire:model="widget_id"> 
                @endif
                    <div class="col-12">
                        <label for="title" class="col-form-label">Widget Title (<span class="text-danger">*</span>):</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" wire:model="title" value="{{old('title')}}" required autocomplete="off">
                        @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <label for="body" class="col-form-label">Widget Body (<span class="text-danger">*</span>):</label>
                        <textarea name="body" class="form-control" cols="30" rows="5" wire:model="body" required></textarea>
                        @error('body') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <label for="reorder" class="col-form-label">Widget Reorder (<span class="text-danger">*</span>):</label>
                        <input type="number" class="form-control @error('reorder') is-invalid @enderror" name="reorder" wire:model="reorder"
                            value="{{old('reorder')}}" required autocomplete="off">
                        @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <label for="title" class="col-form-label">Widget Position (<span class="text-danger">*</span>):</label>
                        <select type="text" class="form-control @error('position') is-invalid @enderror" name="position" wire:model="position">
                            <option value="">Select Widget Position</option>
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                            <option value="other">Other</option>
                        </select>
                        @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                @if ($updateMode)
                <button type="button" class="btn btn-primary" wire:click.prevent="updateWidget()" style="padding: 14px; margin-bottom:10px">Update Widget</button>
                @else
                <button type="button" class="btn btn-primary" wire:click.prevent="storeWidget()" style="padding: 14px; margin-bottom:10px">Add New Widget</button>                               
                @endif

            </div>
        </div>
    </div>
</div>
