@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>

        {{-- <div class="dialogbox">
            <div class="body">
              <span class="tip tip-up"></span>
              <div class="message">
                <div class="bg-white"><strong>{{ $comment->users->name }}</strong></div>
                <span>{{ $comment->comment_body }}</span>
              </div>
            </div>
          </div> --}}

          <div class="container mt-1">
            <div class="d-flex justify-content-center row g-0">
                <div class="col-md-12">
                    <div class="d-flex flex-column comment-section">
                        <div class="bg-white p-1">
                            <div class="d-flex flex-row user-info">
                                <img class="rounded-circle" src="{{ $comment->users->profile_photo_url }}" width="45">
                                <div class="d-flex flex-column justify-content-start ms-2"><span class="d-block font-weight-bold name">{{ $comment->users->name }}</span><span class="date text-black-50">Shared publicly - Jan 2020</span></div>
                            </div>
                            <div class="mt-2 ms-5">
                                <p class="comment-text ps-2">{{ $comment->comment_body }}</p>
                            </div>
                        </div>
                        <div class="bg-white ms-5">
                            <div class="d-flex flex-row fs-12">
                                <div class="like p-2 cursor"><i class="fa fa-thumbs-o-up"></i><span class="ml-1">Like</span></div>
                                <div class="like p-2 cursor"><i class="fa fa-commenting-o"></i><span class="ml-1">Comment</span></div>
                                <div class="like p-2 cursor"><i class="fa fa-share"></i><span class="ms-1">Share</span></div>
                            </div>
                        </div>
                        @auth
                        <div class="p-2 commenter-avatar ms-5">
                            <form method="post" action="{{ route('comments.store')}}" style="width: 100%">
                                @csrf
                                <div class="d-flex flex-row align-items-start"><img class="rounded-circle" src="{{ Auth::user()->profile_photo_url }}
                                " width="30" height="25">
                                <textarea class="form-control ms-1 shadow-none textarea" name="comment_body"></textarea>
                                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />

                                </div>
                                <div class="ps-5 mt-2 text-right">
                                    <button class="btn btn-primary btn-sm shadow-none me-1" type="submit">Post comment</button>
                                    <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                                </div>
                            </form>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>




        @include('livewire.frontend.sub-comment', ['comments' => $comment->replies])
    </div>
@endforeach
