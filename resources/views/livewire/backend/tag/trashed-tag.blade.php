<div>
    @section('title','List of All Tags')
    <style type="text/css">
    th{
        text-align: center;
    }
    tr td{
        padding: 8px;
    }
    .btn{
        padding: 10px;
        margin: 0px; important!
    }
    </style>

    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card p-1">
                    <div class="card-header border-bottom">
                        <h1 class="card-title" style="font-size: 28px">Display All Trashed Tags</h1>
                    </div>
                    <div class="card-datatable table-responsive">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show p-1" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <table wire:ignore id="postsTable" class="table table-bordered table-hover dt-responsive" style="width:100%">
                            <thead>
                            <tr>
                                <th class="min-mobile">#</th>
                                <th class="min-mobile">Title</th>
                                <th class="not-mobile">Slug</th>
                                <th class="not-mobile">Meta Description</th>
                                <th class="not-mobile">Created_by</th>
                                <th class="not-mobile">Created_at</th>
                                <th class="not-mobile no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $total = $data['tags']->count() @endphp
                                @foreach ($data['tags'] as $tag)
                               <tr>
                                  <td>{{ $total-- }}</td>
                                  <td>{{ $tag->title }}</td>
                                  <td>{{ $tag->slug }}</td>
                                  <td>{{ $tag->meta_description }}</td>
                                  <td>
                                      @if(!empty($tag->user->name))
                                          {{ $tag->user->name }}
                                      @else
                                          Creator Not Found 
                                      @endif
                                  </td>
                                  <td style="text-align:center">{{ date('d-M-Y h:i a', strtotime($tag->created_at)); }}</td>
                                  <td style="text-align: center;">
                                    <button type="button" wire:click="restore({{ $tag->id }})" onclick="confirm('Confirm ! You Want to Restore This Tag ?') || event.stopImmediatePropagation()" class="btn btn-relief-success waves-effect waves-float waves-light" style="margin: 2px">
                                        <i class="fas fa-sync fa-lg" alt="{{ __('Restore') }}" style="margin-right: 3px"></i> <span>{{ __('Restore') }}</span>
                                    </button>
                                    <button type="button" onclick="confirm('Confirm ! You Want to Delete This Tag Parmanently?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $tag->id }})" class="btn btn-relief-danger waves-effect waves-float waves-light" style="margin: 2px">
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
    @push('page-js')
    <script type="text/javascript">
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
    </div>
