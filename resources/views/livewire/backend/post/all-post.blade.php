<div>
    @section('title','Show All Post')
    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card p-1">
                    <div class="card-header border-bottom">
                        <div class="row w-100">
                            <div class="col-6"><h1 class="card-title" style="font-size: 28px">Display All Post</h1></div>
                            @canany(['isAdmin', 'isEditor'])
                            <div class="col-6"><a class="btn btn-primary" href="{{ route('admin-panel.post-create') }}">Create New Post</a></div>
                            @endcanany
                            @can('isAuthor')
                            <div class="col-6"><a class="btn btn-primary" href="{{ route('author.post-create') }}">Create New Post</a></div>
                            @endcan
                            @can('isContributor')
                            <div class="col-6"><a class="btn btn-primary" href="{{ route('contributor.post-create') }}">Create New Post</a></div>
                            @endcan
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
                                    <th class="min-mobile text-center">#</th>
                                    <th class="min-mobile">Title</th>
                                    <th class="not-mobile">Slug</th>
                                    <th class="not-mobile no-sort text-center">Image</th>
                                    <th class="not-mobile">Category</th>
                                    <th class="not-mobile text-center">Author</th>
                                    <th class="not-mobile text-center">Publish Status</th>
                                    <th class="not-mobile no-sort text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = $data['posts']->count(); @endphp
                                @foreach ($data['posts'] as $post)
                                    <tr>
                                        <td class="text-center">{{ $i-- }}</td>
                                        <td><a href="{{ route('post.single-post', [$post->category->slug, $post->slug]) }}" target="_blank">{{ $post->title }}</a></td>
                                        <td>{{ $post->slug }}</td>
                                        <td style="padding: 0px; text-align:center">
                                            @if ($post->featured_image)
                                            <img src="{{ asset('storage/post-images/'.$post->featured_image) }}" alt="{{ $post->title }}"
                                                style="width: 40px; height:35px">
                                            @endif
                                        </td>
                                        <td>{{ $post->category->name }}</td>
                                        <td class="text-center">
                                            @if(!empty($post->user->name))
                                            {{ $post->user->name }}
                                            @else
                                                Post Author Not Found !
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($post->publish_status == 0)
                                            @canany(['isAdmin', 'isEditor'])
                                            <button wire:click="updateStatus({{ $post->id }})" class="btn btn-danger">Pending</button>
                                            @endcanany
                                            @canany(['isAuthor', 'isContributor'])
                                            <button class="btn btn-danger">Pending</button>
                                            @endcanany
                                            @elseif($post->publish_status == 2)
                                            <button class="btn btn-secondary">Draft</button>
                                            @else
                                            @canany(['isAdmin', 'isEditor'])
                                            <button wire:click="updateStatus({{ $post->id }})" class="btn btn-success">Publish</button>
                                            @endcanany
                                            @canany(['isAuthor', 'isContributor'])
                                            <button class="btn btn-success">Publish</button>
                                            @endcanany
                                            @endif
                                        </td>
                                        <td>
                                            @canany(['isAdmin', 'isEditor', 'isAuthor'])
                                            <div class="d-inline-flex">
                                                <a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item"
                                                        onclick="confirm('Confirm Move to Trashed This Post ?') || event.stopImmediatePropagation()"
                                                        wire:click.prevent="moveToTrashed({{ $post->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive me-50 font-small-4"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>Move to Trash</a>

                                                        <a href="#" class="dropdown-item" onclick="confirm('Confirm Delete This Post Parmanently ?') || event.stopImmediatePropagation()" wire:click.prevent="parmanentDelete({{ $post->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 me-50 font-small-4"><polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>Parmanent Delete</a>
                                                </div>
                                            </div>
                                            @endcanany
                                            @canany(['isAdmin', 'isEditor'])
                                            <a href="{{ route('admin-panel.edit-post', $post->id) }}" class="item-edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </a>
                                            @endcanany
                                            @can('isAuthor')
                                            <a href="{{ route('author.edit-post', $post->id) }}" class="item-edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </a>
                                            @endcan
                                            @can('isContributor')
                                            <a href="{{ route('contributor.edit-post', $post->id) }}" class="item-edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </a>
                                           @endcan

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="min-mobile">#</th>
                                    <th class="min-mobile">Title</th>
                                    <th class="not-mobile">Slug</th>
                                    <th class="not-mobile no-sort">Image</th>
                                    <th class="not-mobile">Category</th>
                                    <th class="not-mobile">Author</th>
                                    <th class="not-mobile">Publish Status</th>
                                    <th class="not-mobile no-sort">Action</th>
                                </tr>
                            </tfoot>
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
        "order": [0,'desc'],
        "pageLength": 25,
        "columnDefs": [ {
        "targets" : 'no-sort',
        "orderable": false,
        }],

        initComplete: function () {
            this.api().columns(5).every( function () {
                var column = this;
                var select = $('<select class="form-select" style="max-width:120px; max-height:40px; padding:3px!important;"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );
</script>
@endpush
