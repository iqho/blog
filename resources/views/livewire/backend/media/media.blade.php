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
</style>

@endpush

@include('livewire.backend.media.create')

<div class="col-md-2 text-center"><a href="#" class="btn btn-primary" onclick="resetFunction()" data-bs-toggle="modal" data-id="1" data-bs-target="#addMediaModal" style="padding: 14px">Add New Media</a></div>

<div class="row text-center">
    <div class="text-center">
        <button class="filter-button active" data-filter="all">All</button>
        <button class="filter-button" data-filter="category1">Images</button>
        <button class="filter-button" data-filter="category2">Videos</button>
        <button class="filter-button" data-filter="category3">Others</button>
    </div>
<div class="col-lg-3 col-md-4 col-sm-6 col-12 category1">
    <a href="#" class="d-block mb-2 h-100">
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

</script>
@endpush
</div>
