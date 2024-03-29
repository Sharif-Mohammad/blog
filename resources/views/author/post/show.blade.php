@extends('layouts.backend.app')

@section('title', 'Post')

@push('css')

<!-- Bootstrap Select Css -->
    <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
    
@endpush

@section('content')

      <div class="container-fluid">
            
            <a href="{{route('author.post.index')}}" class="btn btn-danger waves-effect">BACK</a>

            @if($post->is_approved == false)
            <button type="button" class="btn btn-success waves-effect pull-right">
                <i class="material-icons">done</i>
                <span>Approve</span>
            </button>
        @else
            <button type="button" class="btn btn-success pull-right" disabled>
                <i class="material-icons">done</i>
                <span>Approved</span>
            </button>
        @endif
        <br><br>
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{$post->title}}
                                <small>Created By <strong><a href="">{{$post->user->name}}</a></strong> on {{$post->created_at->toFormattedDateString()}}</small>
                            </h2>
                        </div>
                        <div class="body">
                           
                                {!! $post->body !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>
                                Categories 
                            </h2>
                        </div>
                        <div class="body">
                           
                            @foreach($post->categories as $category)
                            <span class="label bg-blue">{{$category->name}}</span>
                            @endforeach

                        </div>
                    </div>

                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                Tags 
                            </h2>
                        </div>
                        <div class="body">
                           
                           @foreach($post->tags as $tag)
                            <span class="label bg-green">{{$tag->name}}</span>
                            @endforeach 

                        </div>
                    </div>

                    <div class="card">
                        <div class="header bg-black">
                            <h2>
                                Featured Image 
                            </h2>
                        </div>
                        <div class="body">
                            
                            <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="">

                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
           
        </div>

@endsection

@push('js')

<!-- Select Plugin Js -->
    <script src="{{asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

    <!-- TinyMCE -->
    <script src="{{asset('assets/backend/plugins/tinymce/tinymce.js')}}"></script>

    <script>
        $(function () {

    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '{{asset('assets/backend/plugins/tinymce')}}';
});
    </script>
    
@endpush
