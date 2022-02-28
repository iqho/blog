@section('title', 'All Trashed Widgets')

<div class="row shadow bg-white g-0 px-3 py-3">
    <div class="row mb-3">
        <div class="col-md-9 text-center">
            <h1>List of All Widgets</h1>
        </div>
        <div class="col-md-3 d-flex justify-content-start"><a href="#" class="btn btn-primary float-right"
                data-bs-toggle="modal" data-id="1" data-bs-target="#addWidgetModal" style="padding: 14px">Add New
                Widget</a></div>
    </div>
    <div class="col-6 pe-md-3 pe-sm-1">
        <div class="card border-primary mb-3 text-center float-end w-100">
            <div class="card-title m-0 bg-primary text-white fs-2"
                style="border-bottom: 1px solid #0d6efd!important; padding: 5px 8px;">Left Side Widgets</div>
            <div class="card-body" style="padding: 5px 8px!important; text-align:center!important;">

                @if ($leftWidgets->count() > 0)
                @foreach ($leftWidgets as $leftwidget)
                <div class="card mb-2 align-items-center w-100" style="border: 1px solid #e9e9e9!important;">
                    <div class="card-title m-0 w-100"
                        style="border-bottom: 1px solid #e9e9e9!important; padding: 5px 8px; background-color:#e9e9e9">
                        {{
                        $leftwidget->title }}</div>
                    <div class="card-body" style="padding: 5px 8px!important;">
                        {!! eval('?>'.Blade::compileString($leftwidget->body)) !!}
                    </div>
                    <div class="card-footer border-0 w-100"
                        style="padding: 5px 8px!important; border-top: 1px solid #e9e9e9!important;">
                        <a href="#" onclick="confirm('Confirm Restore This Widget ?') || event.stopImmediatePropagation()"
                            wire:click="restore({{ $leftwidget->id }})"><i class="fas fa-retweet fa-lg" title="Restore"></i> Restore</a> | <a href="#"
                            onclick="confirm('Confirm Delete This Widget Parmanently ?') || event.stopImmediatePropagation()"
                            wire:click.prevent="delete({{ $leftwidget->id }})"><i class="fas fa-trash-alt fa-lg"
                                style="color:red"></i></a>
                    </div>
                </div>
                @endforeach
                @else
                <h4 class="p-2">No Widget Found ! </h4>
                @endif

            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card border-danger mb-1 text-center float-end w-100">
            <div class="card-title m-0 bg-danger text-white fs-2"
                style="border-bottom: 1px solid #dc3545!important; padding: 5px 8px;">Right Side Widgets</div>
            <div class="card-body" style="padding: 5px 8px!important; text-align:center!important;">

                @if ($rightWidgets->count() > 0)
                @foreach ($rightWidgets as $rightwidget)
                <div class="card mb-2 align-items-center w-100" style="border: 1px solid #e9e9e9!important;">
                    <div class="card-title m-0 w-100"
                        style="border-bottom: 1px solid #e9e9e9!important; padding: 5px 8px; background-color:#e9e9e9">
                        {{
                        $rightwidget->title }}</div>
                    <div class="card-body" style="padding: 5px 8px!important;">
                        {!! eval('?>'.Blade::compileString($rightwidget->body)) !!}
                    </div>
                    <div class="card-footer border-0 w-100"
                        style="padding: 5px 8px!important; border-top: 1px solid #e9e9e9!important;">
                        <a href="#" onclick="confirm('Confirm Restore This Widget ?') || event.stopImmediatePropagation()"
                            wire:click="restore({{ $rightwidget->id }})"><i class="fas fa-retweet fa-lg" title="Restore"></i> Restore</a> | <a
                            href="#"
                            onclick="confirm('Confirm Delete This Widget Parmanently ?') || event.stopImmediatePropagation()"
                            wire:click.prevent="delete({{ $rightwidget->id }})"><i class="fas fa-trash-alt fa-lg"
                                style="color:red"></i></a>
                    </div>
                </div>
                @endforeach
                @else
                <h4 class="p-2">No Widget Found ! </h4>
                @endif

            </div>
        </div>
    </div>
</div>