<div>
@section('title','Show All Post')
@push('page-css')
<style>
.filter-button{
    font-size: 18px;
    border: 1px solid #0275d8;
	padding:5px 10px;
    text-align: center;
    color: #fff;
    margin-bottom: 20px;
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
.row-eq-height {
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
}
</style>

@endpush

@include('livewire.backend.media.create')

<div class="col-md-2 text-center"><a href="#" class="btn btn-primary" onclick="resetFunction()" data-bs-toggle="modal" data-id="1" data-bs-target="#addMediaModal" style="padding: 14px">Add New Media</a></div>
    @if (session()->has('message'))
      <div class="alert alert-success alert-dismissible fade show p-1" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

<div class="row text-center row-eq-height">
    <div class="text-center">
        <button class="filter-button active" data-filter="all">All</button>
        <button class="filter-button" data-filter="images">Images</button>
        <button class="filter-button" data-filter="videos">Videos</button>
        <button class="filter-button" data-filter="others">Others</button>
    </div>
  @foreach ($data['media'] as $media)
      @if ($media->media_name)
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 col-6 filter {{ $media->media_type }}">
          <a href="#" class="d-block mb-2 h-100" data-bs-toggle="modal" data-id="1" data-bs-target="#addMediaModal">
            <img class="img-fluid img-thumbnail h-100" src="{{ asset('storage/media/'.$media->media_name) }}" alt="{{ $media->alt }}">
          </a>
        </div>
    @endif
  @endforeach

{{-- <div class="col-lg-3 col-md-4 col-sm-6 col-12 category1">
    <a href="#" class="d-block mb-2 h-100" data-bs-toggle="modal" data-id="1" data-bs-target="#addMediaModal">
      <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/pWkk7iiCoDM/400x300" alt="">
    </a>
  </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-12 category1">
    <a href="#" class="d-block mb-2 h-100">
      <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/aob0ukAYfuI/400x300" alt="">
    </a>
  </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-12 filter category2">
    <a href="#" class="d-block mb-2 h-100">
      <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/EUfxH-pze7s/400x300" alt="">
    </a>
  </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-12 filter category2">
    <a href="#" class="d-block mb-2 h-100">
      <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/M185_qYH8vg/400x300" alt="">
    </a>
  </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-12 filter category2">
    <a href="#" class="d-block mb-2 h-100">
      <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/sesveuG_rNo/400x300" alt="">
    </a>
  </div>
  <div class="col-lg-3 col-md-4  col-sm-6 col-12 filter category3">
    <a href="#" class="d-block mb-2 h-100">
      <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/AvhMzHwiE_0/400x300" alt="">
    </a>
  </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-12 filter category3">
    <a href="#" class="d-block mb-2 h-100">
      <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/2gYsZUmockw/400x300" alt="">
    </a>
  </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-12 filter category3">
    <a href="#" class="d-block mb-2 h-100">
      <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/EMSDtjVHdQ8/400x300" alt="">
    </a>
  </div>
  <div class="col-lg-3 col-md-4  col-sm-6 col-12 filter category3">
    <a href="#" class="d-block mb-2 h-100">
      <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/8mUEy0ABdNE/400x300" alt="">
    </a>
  </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-12 filter category3">
    <a href="#" class="d-block mb-2 h-100">
      <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/G9Rfc1qccH4/400x300" alt="">
    </a>
  </div> --}}

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
