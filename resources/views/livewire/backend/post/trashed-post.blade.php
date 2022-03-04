<div>
    @section('title','Show All Trashed Post')

    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card p-1">
                    <div class="card-header border-bottom">
                        <h1 class="card-title" style="font-size: 28px">Display All Trashed Post</h1>
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
                                    <th class="min-mobile">Title</th>
                                    <th class="not-mobile">Slug</th>
                                    <th class="not-mobile no-sort">Image</th>
                                    <th class="not-mobile">Category</th>
                                    <th class="not-mobile">Author</th>
                                    <th class="not-mobile no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($data['posts'] as $post)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><a href="{{ route('post.single-post', [$post->category->slug, $post->slug]) }}" target="_blank">{{ $post->title }}</a>
                                    </td>
                                    <td>{{ $post->slug }}</td>
                                    <td>
                                    @if ($post->featured_image)
                                    <img src="{{ asset('storage/post-images/'.$post->featured_image) }}" alt="{{ $post->title }}"
                                        style="width: 40px; height:35px">
                                    @endif
                                    </td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>
                                        @canany(['isAdmin', 'isEditor', 'isAuthor'])
                                            <div class="d-inline-flex">
                                                <a class="p-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown"><i class="fas fa-sliders-h"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="#" class="dropdown-item" onclick="confirm('Confirm Restore this Post ?') || event.stopImmediatePropagation()"
                                                            wire:click.prevent="restorePost({{ $post->id }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-archive me-50 font-small-4">
                                                                <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                                                <rect x="1" y="3" width="22" height="5"></rect>
                                                                <line x1="10" y1="12" x2="14" y2="12"></line>
                                                            </svg>Restore Post</a>
                                            
                                                    <a href="#" class="dropdown-item"
                                                        onclick="confirm('Confirm Delete This Post Parmanently ?') || event.stopImmediatePropagation()"
                                                        wire:click.prevent="parmanentDelete({{ $post->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-trash-2 me-50 font-small-4">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>Parmanent Delete</a>
                                                </div>
                                            </div>
                                        @endcanany
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
        }]
    } );
} );
</script>
@endpush

