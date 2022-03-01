<?php $dash.='-- '; ?>

{{-- @if (count($subcomments) > 0)
@else
No
@endif --}}

{{-- @foreach ($subcomments as $subcom) --}}
{{-- <tr>
    <td style="text-align: center">{{ $i-- }}</td>
    <td><a href="{{ route('post.single-post', [$comment->posts->category->slug, $comment->posts->slug]) }}" target="_blank">{{ $subcom->posts->title }}</a></td>
    <td style="padding: 0px 4px;">{{ $subcom->comment_body }}</td>
    <td>
        @if(!empty($subcom->users->name))
        {{ $subcom->users->name }}
        @else
            Comment Author Not Found !
        @endif
        </td>
    <td><div class="d-inline-flex">
        <a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4">
                <circle cx="12" cy="12" r="1"></circle>
                <circle cx="12" cy="5" r="1"></circle>
                <circle cx="12" cy="19" r="1"></circle>
            </svg>
        </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="#" class="dropdown-item"
                    onclick="confirm('Confirm Delete This Category ?') || event.stopImmediatePropagation()"
                    wire:click.prevent="moveToTrashed({{ $subcom->id }})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive me-50 font-small-4"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>Move to Trash</a>

                    <a href="#" class="dropdown-item" onclick="confirm('Confirm Delete This Post Parmanently ?') || event.stopImmediatePropagation()" wire:click.prevent="parmanentDelete({{ $subcom->id }})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 me-50 font-small-4"><polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>Parmanent Delete</a>
                    </div>
            </div>
                        <a href="{{ route('admin-panel.edit-post', $subcom->id) }}" class="item-edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </a>
    </td>
</tr> --}}


{{-- @if(count($subcom->subcomment))
@include('livewire.backend.comment.sub-comment', ['subcomments' => $subcom->subcomment])
@endif
@endforeach --}}
