<div class="col-lg-8">
    <div class="row">
        {{ $post->title }}
    </div>
    <hr>
    <div class="row">
        {!! $post->description !!}
    </div>
    <hr>
    <div class="row">
       <div class="col-4">Category: {{ $post->category->name }}</div> 
       <div class="col-8">Tags: 
            @foreach ($post->tags as $tag)
            <a style="background-color: gray; color:red; padding:5px" href="#">{{ $tag->title }}</a>
            @endforeach
        </div> 
 
    </div>

</div>
