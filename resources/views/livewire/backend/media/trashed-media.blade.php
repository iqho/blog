<div>
    @section('title','Show All Trashed Post')
    @push('page-css')
    <style>
    .btn-link:hover{
        background-color: rgb(218, 218, 218);
        }

    @media only screen and (max-width: 278px) {
      .col-xs-12 {
        width: 100%;
      }
    }
    *[tooltip]:focus:after {
    content: attr(tooltip);
    display:block;
    position: absolute;
    margin-top: 40px;
    margin-right: 80px;
    top: 0;
    right: 0;
    color: green;
    }
    input[type="text"]:read-only:not([read-only="false"]) {
        background-color: rgb(248, 248, 248);
    }
    textarea:read-only:not([read-only="false"]) { background-color: rgb(248, 248, 248);; }
    select:disabled:not([read-only="false"]) { background-color: rgb(248, 248, 248);; }
    table.dataTable td {
                padding: 7px;
                }
            th{
                text-align: center;
            }
    </style>
    @endpush
@php
function formatSizeUnits($bytes)
{
$label = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
for ( $i = 0; $bytes >= 1024 && $i < ( count( $label ) -1 ); $bytes /=1024, $i++ ); return ( round( $bytes, 2 ) . " " .
    $label[$i] ); } function getFilesize($file, $digits=2) { if (is_file($file)) { $filePath=$file; if
    (!realpath($filePath)) { $filePath=$_SERVER["DOCUMENT_ROOT"].$filePath; } $fileSize=filesize($filePath);
    $sizes=array("TB","GB","MB","KB","B"); $total=count($sizes); while ($total-- && $fileSize> 1024) {
    $fileSize /= 1024;
    }
    return round($fileSize, $digits)." ".$sizes[$total];
    }
    return false;
    }
@endphp

@include('livewire.backend.media.trashed-details-modal')

    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card p-1">
                    <div class="card-header border-bottom">
                        <h1 class="card-title" style="font-size: 28px">Display All Trashed Media</h1>
                    </div>
                    @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show p-1" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-datatable table-responsive" wire:ignore>
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
                            @php $i = $data['media']->count(); @endphp
                            @foreach ($data['media'] as $media)
                                <tr>
                                    <td class="text-center">{{ $i-- }}</td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#detailsTrashedMediaModal" wire:click.prevent="details({{ $media->id }})">{{ $media->title }}</a>
                                    </td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#detailsTrashedMediaModal" wire:click.prevent="details({{ $media->id }})">{{ $media->slug }}</a></td>
                                    <td class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#detailsTrashedMediaModal" wire:click="details({{ $media->id }})"><img src="{{ asset('storage/media/'.$media->media_name) }}" width="40" height="40" alt="{{ $media->title }}"></a></td>
                                    <td class="text-center">{{ $media->users->name }}</td>
                                    <td class="text-center" style="text-align: center; min-width: 200px">

                                        <button type="button" wire:click="restore({{ $media->id }})" onclick="confirm('Confirm ! You Want to Restore This Media ?') || event.stopImmediatePropagation()" class="btn btn-relief-success waves-effect waves-float waves-light" style="margin: 2px; padding: 10px">
                                            <i class="fas fa-sync fa-lg" alt="{{ __('Restore') }}" style="margin-right: 3px"></i> <span>{{ __('Restore') }}</span>
                                        </button>
                                        <button type="button" onclick="confirm('Confirm ! You Want to Delete This Media Parmanently?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $media->id }})" class="btn btn-relief-danger waves-effect waves-float waves-light" style="margin: 2px; padding: 10px">
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
        <script>
                // clipboard.js
                var clipboard = new ClipboardJS('.copy-btn', {
                    container: document.getElementById('detailsTrashedMediaModal')
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
