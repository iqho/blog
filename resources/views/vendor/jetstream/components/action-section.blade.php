<div {{ $attributes->merge(['class' => 'border border-danger']) }}>
    <x-jet-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-jet-section-title>

    <div class="col-md-12">
        <div class="border border-primary">
            {{ $content }}
        </div>
    </div>
</div>
