@extends('layouts.blog-page')

@section('title', $post->title)

@section('slug', $post->slug)

@section('content')
{{ $post->content }}
@endsection

<!-- Sidebar : Diğer 11 yazıyı görüntüleme - Şuanki postu gizlemek için ayrıca ekstra kontrol yapıyoruz -->
@section('sidebar')
@include('layouts.partials.blog-sidebar', ['otherPosts' => $otherPosts, 'currentPost' => $post])
@endsection