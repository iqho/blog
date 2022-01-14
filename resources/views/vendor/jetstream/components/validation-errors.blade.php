@if ($errors->any())
    <div {{ $attributes }}>
        <div class="list-group-item list-group-item-danger mb-1">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="list-group mb-1">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger mb-1">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
