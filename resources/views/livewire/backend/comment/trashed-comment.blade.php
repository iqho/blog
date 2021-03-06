<div>
    @section('title','Show All Comments')
    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card p-1">
                    <div class="card-header border-bottom">
                        <div class="row w-100">
                            <div class="col"><h1 class="card-title" style="font-size: 28px">Display All Trashed Comments</h1></div>
                        </div>

                    </div>
                    <div class="card-datatable table-responsive">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show p-1" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <table id="postsTable" class="table table-bordered table-hover dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="min-mobile">#</th>
                                    <th class="min-mobile">Post Title</th>
                                    <th class="not-mobile">Comments</th>
                                    <th class="not-mobile">Author</th>
                                    <th class="not-mobile no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = $all_comments->count(); @endphp
                                @foreach ($all_comments as $comment)
                                    <tr>
                                        <td style="text-align: center">{{ $i-- }}</td>
                                        <td><a href="{{ route('post.single-post', [$comment->posts->category->slug, $comment->posts->slug]) }}" target="_blank">{{ $comment->posts->title }}</a></td>
                                        <td style="padding: 0px 4px;">{{ $comment->comment_body }}</td>
                                        <td>
                                            @if(!empty($comment->user->name))
                                            {{ $comment->user->name }}
                                            @else
                                                Comment Author Not Found
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
                                                        wire:click.prevent="moveToTrashed({{ $comment->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive me-50 font-small-4"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>Move to Trash</a>

                                                        <a href="#" class="dropdown-item" onclick="confirm('Confirm Delete This Post Parmanently ?') || event.stopImmediatePropagation()" wire:click.prevent="parmanentDelete({{ $comment->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 me-50 font-small-4"><polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>Parmanent Delete</a>
                                                        </div>
                                                </div>
                                                            <a href="{{ route('admin-panel.edit-post', $comment->id) }}" class="item-edit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4">
                                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                </svg>
                                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('page-js')
<script>
    $(document).ready(function() {
    $('#postsTable').DataTable( {
        "order": [[ 0, "desc" ]],
        "pageLength": 25,
        "columnDefs": [ {
        "targets" : 'no-sort',
        "orderable": false,
        }],
    } );
} );
</script>
@endpush
