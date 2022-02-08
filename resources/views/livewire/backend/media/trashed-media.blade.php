<div>
    @section('title','Show All Trashed Post')

    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card p-1">
                    <div class="card-header border-bottom">
                        <h1 class="card-title" style="font-size: 28px">Display All Trashed Media</h1>
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
                                <th class="not-mobile no-sort">Media</th>
                                <th class="not-mobile">User</th>
                                <th class="not-mobile no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 1; @endphp
                            @foreach ($data['media'] as $media)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><a href="#">{{ $media->title }}</a>
                                    </td>
                                    <td>{{ $media->slug }}</td>
                                    <td><img src="{{ asset('storage/media/'.$media->media_name) }}" width="40" height="40" alt="{{ $media->title }}"> </td>
                                    <td>{{ $media->users->name }}</td>
                                    <td style="text-align: center;">
                                        <button type="button" wire:click="restore({{ $media->id }})" onclick="confirm('Confirm ! You Want to Restore This Category ?') || event.stopImmediatePropagation()" class="btn btn-relief-success waves-effect waves-float waves-light" style="margin: 2px">
                                            <i class="fas fa-sync fa-lg" alt="{{ __('Restore') }}" style="margin-right: 3px"></i> <span>{{ __('Restore') }}</span>
                                        </button>
                                        <button type="button" onclick="confirm('Confirm ! You Want to Delete This Category Parmanently?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $media->id }})" class="btn btn-relief-danger waves-effect waves-float waves-light" style="margin: 2px">
                                            <i class="fas fa-trash-alt fa-lg" style="margin-right: 3px"></i> <span>P. Delete</span>
                                        </button>
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
