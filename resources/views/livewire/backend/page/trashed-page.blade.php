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
                        <table id="postsTable" class="table table-bordered table-hover dt-responsive"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="min-mobile">#</th>
                                    <th class="min-mobile">Title</th>
                                    <th class="not-mobile">Slug</th>
                                    <th class="not-mobile no-sort">Image</th>
                                    <th class="not-mobile">Author</th>
                                    <th class="not-mobile no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($data['pages'] as $page)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ $page->slug }}</td>
                                    <td style="padding: 0px; text-align:center">
                                        @if ($page->featured_image)
                                        <img src="{{ asset('storage/page-images/'.$page->featured_image) }}" alt="{{ $page->title }}"
                                            style="width: 40px; height:35px">
                                        @endif
                                    </td>
                                    <td>{{ $page->user->name }}</td>
                                    <td>
                                        <div class="d-inline-flex">
                                            <a class="p-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown"><i class="fas fa-sliders-h"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item"
                                                    onclick="confirm('Confirm Restore This Page ?') || event.stopImmediatePropagation()"
                                                    wire:click.prevent="restorePage({{ $page->id }})"><i class="fas fa-retweet"></i> Restore Page</a>

                                                <a href="#" class="dropdown-item"
                                                    onclick="confirm('Confirm Delete This Page Parmanently ?') || event.stopImmediatePropagation()"
                                                    wire:click.prevent="parmanentDelete({{ $page->id }})">
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
                                        {{-- <a href="{{ route('page.single-page', $page->id) }}" class="item-edit"><i class="fas fa-eye"></i></a> --}}
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

