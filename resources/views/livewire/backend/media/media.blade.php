<div class="card p-1">
@section('title','Show All Media')
@push('page-css')
<style>
.filter-button{
    font-size: 18px;
    border: 1px solid #0275d8;
	padding:5px 10px;
    text-align: center;
    color: #fff;
	background:#0275d8;
    border-radius: 5px 5px 0px 0px;
}
.filter-button:hover,
.filter-button:focus,
.filter-button.active{
    color: #ffffff;
    background-color:#d9534f;
	outline:none;
    border: 1px solid #d9534f;
}
.btn-link:hover{
    background-color: rgb(218, 218, 218);
    }
.img-wrapper {
position: relative;
padding-bottom: 130px;
overflow: hidden;
width: 100%;
}
.img-wrapper img {
position: absolute;
top:0;
left:0;
width:100%;
height:100%;
}
.filter{
    padding: 5px;
    /* border: 1px solid blue; */
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


    @if (session()->has('message'))
      <div class="alert alert-success alert-dismissible fade show p-1" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

<div class="row g-0">
    <div class="col-12 text-center w-100 my-1"><h1>Display All Media</h1></div>
    <hr/>
        <div class="row g-0 px-1 align-items-center h-100">
            <div class="col-md-3 col-sm-3 col-12 text-md-start text-center">
                <a class="btn btn-outline-danger" href="{{ route('admin-panel.media.list-view') }}"><i class="fa fa-bars me-1"></i> List View</a>
            </div>
            <div class="col-md-5 col-sm-5 col-12 g-0 text-center">
                <button class="filter-button active" data-filter="all">All</button>
                <button class="filter-button" data-filter="images">Images</button>
                <button class="filter-button" data-filter="videos">Videos</button>
                <button class="filter-button" data-filter="others">Others</button>
            </div>
            <div class="col-md-4 col-sm-4 col-12 text-md-end text-center">
                <div class="input-group">
                <button class="btn btn-primary btn-lg" onclick="resetFunction()" data-bs-toggle="modal" data-id="1" data-bs-target="#addMediaModal">Add New Media</button>
                    <input type="text" class="form-control" placeholder="Search Media by Title" style="max-width: 250px; margin-left: 5px" wire:model="searchTerm" />
                </div>
            </div>
        </div>
        <div class="row g-0 mt-1">
            @forelse($data['media'] as $media)
                    <div class="col-md-2 col-sm-4 col-6 col-xs-12 filter {{ $media->media_type }}">
                    <a href="#" class="d-block img-wrapper" data-bs-toggle="modal" data-bs-target="#updateMediaModal" wire:click="details({{ $media->id }})">
                        <img class="img-responsive img-thumbnail" src="{{ asset('storage/media/'.$media->media_name) }}" alt="{{ $media->alt }}">
                    </a>
                    </div>
            @empty
                <h2 class="col-12 w-100 text-center my-2">No Media Found </h2>
            @endforelse
            <div class="row">{{ $data['media']->onEachSide(2)->links('backend.includes.pagination-custom') }}</div>
        </div>
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
@endpush
</div>
