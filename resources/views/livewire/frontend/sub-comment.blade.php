@foreach($comments as $comment)
    <div class="display-comment @if($comment->parent_id != null) ms-1 ms-sm-2 ms-md-3 @endif ">
          <div class="container mt-1">
            <div class="d-flex justify-content-center row g-0">
                <div class="col-md-12">
                    <div class="d-flex flex-column comment-section">
                        <div class="g-0 p-1 d-flex flex-row w-100">
                            <div class="col-11 g-0" style="max-width: 45px"><img class="rounded-circle" title="{{ $comment->user->name }}" src="{{ $comment->user->profile_photo_url }}" width="40" height="35"></div>
                            <div class="col-11 triangle ms-1">
                                <div class="d-flex flex-column justify-content-start ms-2">
                                    <span class="d-block font-weight-bold name">{{ $comment->user->name }}</span><span class="date text-black-50">{{ date('d-M-Y h:i a', strtotime($comment->created_at)); }}</span></div>
                                <div class="mt-1">
                                    <p class="comment-text ps-2">{!! $comment->comment_body !!}</p>
                                </div>
                                <div class="d-flex flex-row fs-12">
                                    <div class="like p-2 cursor"><i class="fa-solid fa-thumbs-up"></i><span class="ms-1">Like</span></div>
                                    <div class="like p-2 cursor"><a class="showreply" id="{{ $comment->id }}"><i class="fa-solid fa-reply"></i><span class="ms-1">Reply</span></a></div>
                                    <div style="display: none" id="copyname{{ $comment->id }}">{{ '@' }}{{ $comment->user->name }}</div>
                                </div>
                            </div>
                        </div>
                        @auth
                        <div class="p-2 comment-reply-box{{ $comment->id }} commenter-avatar ms-5" style="display: none">
                            <form method="post" action="{{ route('comments.store')}}" style="width: 100%">
                                @csrf
                                <div class="d-flex flex-row align-items-start">
                                <img class="rounded-circle" title="{{ Auth::user()->name }}" src="{{ Auth::user()->profile_photo_url }}
                                " width="40" height="35">

                                <div class="comment-textarea-triangle w-100 ms-2 p-1">
                                <textarea class="form-control ms-1 shadow-none textarea border-0 p-0" id="comment_body{{ $comment->id }}" name="comment_body" placeholder="Write Your Comment Here" rows="3"></textarea>
                                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                                </div>
                                </div>
                                <div class="m-2 d-flex justify-content-end">
                                    <button class="btn btn-primary btn-sm shadow-none me-1"  type="submit">Reply Comment</button>
                                    <a class="btn btn-outline-primary btn-sm ml-1 shadow-none closereply" id="{{ $comment->id }}" type="button">Cancel</a>
                                </div>
                            </form>
                        </div>
                        @else
                        <div class="p-2 comment-reply-box{{ $comment->id }} commenter-avatar ms-5" style="display: none"><h6>Please <a href="{{ url('/login') }}">Login</a> first for write a new comments</h6><a class="btn btn-outline-primary btn-sm ml-1 shadow-none closereply" id="{{ $comment->id }}" type="button">Cancel</a></div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.frontend.sub-comment', ['comments' => $comment->replies])
    </div>

@endforeach

