@extends('layouts.frontend.app')

@section('title', 'Blog')

@push('css')

    <link href="{{asset('assets/frontend/css/home/styles.css')}}" rel="stylesheet">

    <link href="{{asset('assets/frontend/css/home/responsive.css')}}" rel="stylesheet">

    <style>
        .favourite_posts{
            color: blue;
        }
    </style>

@endpush

@section('content')

 <div class="main-slider">
        <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
            data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
            data-swiper-breakpoints="true" data-swiper-loop="true" >
            <div class="swiper-wrapper">

                @foreach($categories as $category)
                <div class="swiper-slide">
                    <a class="slider-category" href="#">
                        <div class="blog-image"><img src="{{ Storage::disk('public')->url('category/slider/'.$category->image) }}" alt="{{$category->name}}"></div>

                        <div class="category">
                            <div class="display-table center-text">
                                <div class="display-table-cell">
                                    <h3><b>{{$category->name}}</b></h3>
                                </div>
                            </div>
                        </div>

                    </a>
                </div><!-- swiper-slide -->
                @endforeach

            </div><!-- swiper-wrapper -->

        </div><!-- swiper-container -->

    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">

                @foreach($posts as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'. $post->image)}}" alt="{{$post->title}}"></div>

                            <a class="avatar" href="#"><img src="{{Storage::disk('public')->url('profile/'. $post->user->image)}}" alt="Profile Image"></a>

                            <div class="blog-info">

                                <h4 class="title"><a href="{{route('post.details', $post->slug)}}"><b>{{$post->title}}</b></a></h4>

                                <ul class="post-footer">
                                <li>
                                    @guest
                                        <a href="javascript:void(0);" onclick="toastr.info('To add favourite post. You need to login first.', 'Info', {
                                            CloseButton: true,
                                            ProgressBar: true
                                        })"><i class="ion-heart"></i>{{$post->favourite_to_users->count()}}</a>
                                    @else
                                        <a href="javascript:void(0);" onclick="document.getElementById('favourite-form-{{$post->id}}').submit();" class="{{!Auth::user()->favourite_posts->where('pivot.post_id', $post->id)->count() == 0 ? 'favourite_posts' : ''}}"><i class="ion-heart"></i>{{$post->favourite_to_users->count()}}</a>

                                        <form id="favourite-form-{{$post->id}}" action="{{route('post.favourite', $post->id)}}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @endguest
                                </li>
                                    
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                                </ul>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
                @endforeach

            </div><!-- row -->

            <a class="load-more-btn" href="#"><b>LOAD MORE</b></a>

        </div><!-- container -->
    </section><!-- section -->

@endsection

@push('js')
    
@endpush