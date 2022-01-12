<div {{ $attributes->merge(['class' => 'row mt-2']) }}>
    <x-jet-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-jet-section-title>

    <div class="col-md-12 shadow rounded pb-2 ms-2">
            {{ $content }}
    </div>
</div>
