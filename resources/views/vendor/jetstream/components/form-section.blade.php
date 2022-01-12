@props(['submit'])

<div {{ $attributes->merge(['class' => 'col-md-12']) }}>
    <x-jet-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-jet-section-title>

    <div class="col-md-12">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="shadow p-2 ps-3 mb-0 rounded">
                    {{ $form }}
            @if (isset($actions))
                <div class="col-md-12 text-center p-0 rounded">
                    {{ $actions }}
                </div>
            @endif
        </div>
        </form>
    </div>
</div>
