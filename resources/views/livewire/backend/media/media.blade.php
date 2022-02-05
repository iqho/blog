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
</style>

@endpush

@include('livewire.backend.media.create')

    @if (session()->has('message'))
      <div class="alert alert-success alert-dismissible fade show p-1" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

<div class="row g-0">
        <div class="row g-0 px-1 align-items-center h-100">    
            <div class="col-md-5 col-sm-5 col-12">
                <button class="btn btn-primary btn-lg" onclick="resetFunction()" data-bs-toggle="modal" data-id="1" data-bs-target="#addMediaModal">Add New Media</button>
            </div>    
            <div class="col-md-7 col-sm-7 col-12 g-0 align-items-center h-100">
                <button class="filter-button active" data-filter="all">All</button>
                <button class="filter-button" data-filter="images">Images</button>
                <button class="filter-button" data-filter="videos">Videos</button>
                <button class="filter-button" data-filter="others">Others</button> 
            </div> 
        </div>
        <div class="row g-0 mt-1">
            @foreach ($data['media'] as $media)
                @if ($media->media_name)
                    <div class="col-md-2 col-sm-4 col-6 col-xs-12 filter {{ $media->media_type }}">
                    <a href="#" class="d-block img-wrapper" data-bs-toggle="modal" data-id="1" data-bs-target="#addMediaModal" wire:click="details({{ $media->id }})">
                        <img class="img-responsive img-thumbnail" src="{{ asset('storage/media/'.$media->media_name) }}" alt="{{ $media->alt }}">
                    </a>
                    </div>
                @endif
            @endforeach
        </div>
</div>
@push('page-js')
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
          });

        //Seleceted Format
        function checkImageExtention() {
                var fileInput = document.getElementById('media_name');
                var filePath = document.getElementById('media_name').value;
                var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                if(!allowedExtensions.exec(filePath)){
                if(!document.getElementById("error-msg").childNodes.length){
                var gendererror = document.createElement("span");
                gendererror.innerHTML = "Supported Image Extention Only .jpeg/.jpg/.png/.gif";
                document.getElementById("error-msg").appendChild(gendererror);
                }
                //alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
                fileInput.value = '';
                return false;
                }
                }

</script>
@endpush
</div>
