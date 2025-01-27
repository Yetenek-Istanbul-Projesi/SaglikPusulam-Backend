@extends('layouts.master')

@section('title', 'Blog')

@section('content')
    <div class="section-photo1">
        <img src="{{ asset('assets/img/Blog_banner.svg') }}" alt=""
            style="width: 100%; object-fit: cover; height: 25rem;">
    </div>
    <nav aria-label="breadcrumb" style="padding:2rem;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="text-decoration-none">Ana Sayfa</a></li>
            <li class="breadcrumb-item"><a href="{{ url('pages/blog') }}" class="text-primary">Blog</a></li>
        </ol>
    </nav>
    <h2 class="start" style="color: #3465FD; margin-left: 60px; font-weight:600;">Blog Yazıları</h2>

    <div class="container blog-cards p-5" style="margin-top: 10px;">
        <div class="d-flex flex-wrap blog-row justify-content-start gap-5 rounded mb-5">
            <div class="col-12 col-sm-6 col-md-4 col-xl-3 col-xxl-2">
                @foreach ($posts as $post)
                <div class="card p-4 h-90 hvr-glow" style="width: 20rem; border-radius: 20px;">
                    <div class="img-src">
                        <img src="{{ asset('assets/img/'.$post->card_image) }}"
                            class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 1.05rem;">{{ $post->card_title }}</h5>
                        <br>
                        <p class="card-text" style="font-size: 0.8rem;">{{ $post->card_summary }}</p>
                        <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary" style="border-radius: 20px;">Devamını
                            Oku</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
