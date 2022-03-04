<div>
    @section('title','List of All Tags')
    <style type="text/css">
    tr td{
        padding: 8px;
    }
    .btn{
        padding: 10px;
        margin: 0px; important!
    }
    </style>

@include('livewire.backend.tag.create')

    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card p-1">
                    <div class="card-header border-bottom">
                        <h1 class="card-title" style="font-size: 28px">Display All Tags</h1>
                            <button class="btn btn-primary btn-lg" wire:click.prevent="cancel()" data-bs-toggle="modal" data-id="1" data-bs-target="#TagModal">Add New Tag</button>

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
                                  <td style="text-align: center; max-width:50px;">
                                    <a href="#" data-bs-toggle="modal" data-id="1" data-bs-target="#TagModal" wire:click="edit({{ $tag->id }})"><i class="fas fa-edit fa-lg"></i></a> | <a href="#" onclick="confirm('Confirm Move This Tag to Trashed ?') || event.stopImmediatePropagation()" wire:click.prevent="trashed({{ $tag->id }})"><i class="fas fa-trash-alt fa-lg" style="color:red"></i></a>
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
      window.livewire.on('tagStore', () => {
            $('#TagModal').modal('hide');
            window.location.reload(true);
        });

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
