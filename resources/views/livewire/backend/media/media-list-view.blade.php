<div>
    @section('title','Show All Media')
    @push('page-css')
        <style>
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
        </style>
    @endpush

    @include('livewire.backend.media.create')
    @include('livewire.backend.media.edit')

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
    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card p-1">
                    <div class="card-header border-bottom">
                        <a class="btn btn-outline-danger" href="{{ route('admin-panel.media') }}"><i class="fa fa-th-large me-1"></i> Grid View</a>
                        <h1 class="card-title" style="font-size: 28px">Display All Media</h1>
                            <button class="btn btn-primary btn-lg" onclick="resetFunction()" data-bs-toggle="modal" data-id="1" data-bs-target="#addMediaModal">Add New Media</button>

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
                                <th class="not-mobile no-sort">Media</th>
                                <th class="not-mobile">User</th>
                                <th class="not-mobile no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = $data['media']->count(); @endphp
                            @foreach ($data['media'] as $media)
                                <tr>
                                    <td>{{ $i-- }}</td>
                                    <td><a href="#">{{ $media->title }}</a>
                                    </td>
                                    <td>{{ $media->slug }}</td>
                                    <td><img src="{{ asset('storage/media/'.$media->media_name) }}" width="40" height="40" alt="{{ $media->title }}"> </td>
                                    <td>{{ $media->users->name }}</td>
                                    <td>
                                        <div class="d-inline-flex">
                                            <a class="pe-1 dropdown-toggle hide-arrow text-primary"
                                               data-bs-toggle="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-more-vertical font-small-4">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="5" r="1"></circle>
                                                    <circle cx="12" cy="19" r="1"></circle>
                                                </svg>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item"
                                                   onclick="confirm('Confirm Trashed this Media ?') || event.stopImmediatePropagation()"
                                                   wire:click.prevent="trashed({{ $media->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-archive me-50 font-small-4">
                                                        <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                                        <rect x="1" y="3" width="22" height="5"></rect>
                                                        <line x1="10" y1="12" x2="14" y2="12"></line>
                                                    </svg>Move to Trashed</a>

                                                <a href="#" class="dropdown-item delete-record"
                                                   onclick="confirm('Confirm ! You Want to Delete This Media Parmanently ?') || event.stopImmediatePropagation()"
                                                   wire:click.prevent="parmanentDelete({{ $media->id }})">
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
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#updateMediaModal" wire:click="details({{ $media->id }})" class="item-edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-edit font-small-4">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                </path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                </path>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".filter-button").click(function(){
                var value = $(this).attr('data-filter');
                if(value == "all")
                {
                    $('.filter').show('1000');
                }
                else
                {
                    $(".filter").not('.'+value).hide('3000');
                    $('.filter').filter('.'+value).show('3000');
                }

                if ($(".filter-button").removeClass("active")) {
                    $(this).removeClass("active");
                }
                $(this).addClass("active");
            });
        });

        // Media Modal Emit
        window.livewire.on('mediaStore', () => {
            $('#addMediaModal').modal('hide');
            window.location.reload(true);
            //window.setTimeout(function(){location.reload(true)}, 3000);
        });
        window.livewire.on('mediaUpdate', () => {
            $('#updateMediaModal').modal('hide');
            window.location.reload(true);
        });

        //Seleceted Format
        function checkImageExtention() {
            var fileInput = document.getElementById('media_name');
            var filePath = document.getElementById('media_name').value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.mp4|\.mp3|\.pdf)$/i;
            if(!allowedExtensions.exec(filePath)){
                if(!document.getElementById("error-msg").childNodes.length){
                    var gendererror = document.createElement("span");
                    gendererror.innerHTML = "Supported Image Extention Only .jpeg/.jpg/.png/.gif/.mp4/.mp3/.pdf";
                    document.getElementById("error-msg").appendChild(gendererror);
                }
                fileInput.value = '';
                return false;
            }
        }
        function checkImageExtentionupdate() {
            var fileInput = document.getElementById('media_name3');
            var filePath = document.getElementById('media_name3').value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.mp4|\.mp3|\.pdf)$/i;
            if(!allowedExtensions.exec(filePath)){
                if(!document.getElementById("error-msg3").childNodes.length){
                    var gendererror = document.createElement("span");
                    gendererror.innerHTML = "Supported Image Extention Only .jpeg/.jpg/.png/.gif/.mp4/.mp3/.pdf";
                    document.getElementById("error-msg3").appendChild(gendererror);
                }
                fileInput.value = '';
                return false;
            }
        }

        // clipboard.js
        var clipboard = new ClipboardJS('.copy-btn', {
            container: document.getElementById('addMediaModal'),
            container: document.getElementById('updateMediaModal')
        });

        // $('#updateMediaModal').on('hidden.bs.modal', function () {
        // document.getElementById("updateForm").reset();
        // });


    </script>

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
