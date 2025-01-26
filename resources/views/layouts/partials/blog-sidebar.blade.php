<div class="col-lg-4 col-md-5" style="padding-right: 50px; margin-inline-start: auto;">
    <h2 class="text-primary mb-4 fw-bold">Diğer Yazılar</h2>

    @foreach ($otherPosts as $post)
        @if ($post->id != $currentPost->id)
            <a href="{{ url('pages/blog/' . $post->slug) }}" class="text-decoration-none">
                <div class="card mb-3 blog_kart hvr-glow">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('assets/img/' . $post->card_image) }}" class="img-fluid blog_kart_img"
                                alt="Kart Resmi">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h6 class="text-muted">{{ $post->updated_at }}</h6>
                                <p class="card-text fw-medium">{{ $post->card_title }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endif
    @endforeach

</div>
