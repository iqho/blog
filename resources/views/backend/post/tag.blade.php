<x-backend-layout>
    @section('title', 'Create New Post')
    <style>
    .form-label{
      font-size: 16px;
    }
    .accordion-button::after {
    background-image: url("{{ asset('backend/assets/images/arrow/arrow.png') }}");
    transition: all 0.5s;
    }
    .accordion-button:not(.collapsed)::after {
    background-image: url("{{ asset('backend/assets/images/arrow/arrow.png') }}");
    transition: all 0.5s;
    }

    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: #ffffff;
        background: #2196f3;
        padding: 3px 7px;
        border-radius: 3px;
    }

    .bootstrap-tagsinput {
        width: 100%;
    }
    </style>

    @push('page-css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
            rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/assets/ckeditor/styles.css') }}">
    @endpush

    <div class="row">
        <div class="col-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="{{ route('admin.tag-store') }}" method="post" enctype="multipart/form-data">
            @csrf


            Tags <input class="form-control" type="text" data-role="tagsinput" name="tags" value="{{ old('tags') }}">
            <div class="invalid-feedback">Please Write Tags.</div>
            @if ($errors->has('tags'))
            <span class="text-danger">{{ $errors->first('tags') }}</span>
            @endif

            <input type="submit" value="Post" class="btn btn-primary">

            </form>
        </div>
    </div>



        @push('page-js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
        @endpush
    </x-backend-layout>


