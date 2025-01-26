@extends('layouts.master')

@section('title', 'Karşılaştırma Listesi')
@section('styles')
    <link href="{{ asset('css/pages/profile/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="wrapper" class="container" style="padding-left: 55px;">
        <div class="row">

            <!-- Sol Taraf -->
            <div class="col-12 col-xl-3 col-lg-4 d-flex mt-5 vh-100" id="left-content">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('assets/img/Rectangle 48.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="#" class="card-link">
                            <p style="text-align: center;">Fotoğrafı Değiştir</p>
                        </a>
                        <h5 class="card-title" style="text-align: center;">Ad Soyad</h5>
                    </div>

                    <a href="{{ url('account/profile/index') }}" class="btn btn-outline-primary btn-lg">Profil
                        Bilgileri</a></br>
                    <a href="{{ url('account/profile/favorite-list') }}"
                        class="btn btn-outline-primary btn-lg">Favoriler</a></br>
                    <a href="{{ url('account/profile/security') }}" class="btn btn-outline-primary btn-lg">Güvenlik</a></br>
                    <a href="{{ url('account/profile/compare-list') }}" class="btn btn-primary btn-lg">Karşılaştırma
                        Listesi</a></br>
                    <a href="javascript:void(0);" class="btn btn-outline-primary btn-lg">Çıkış Yap</a></br>
                </div>
            </div>

            <!-- Sağ Taraf -->
            <div class="container-fluid col-12 col-xl-9 col-lg-8 min-vh-100" style="padding-left: 55px;" id="right-content">
                <div class="search-title mb-3">
                    <h4>Karşılaştırma Listesi</h4>
                </div>

                <div class="row row-cols-1 row-cols-md-2 g-4 card-container">
                    <div class="col">
                        <div class="card h-100 sc1-card hvr-glow">
                            <img src="{{ asset('assets/img/600x400.png') }}" class="card-img-top" alt="Optometri">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-success"><i class="bi bi-circle-fill me-1"></i>Açık</span>
                                    <div class="no-style d-flex gap-2">
                                        <a href="javascript:void(0);" class="toggle-container">
                                            <i class="fa-regular fa-heart toggle-heart" onclick="toggleHeart(this)"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="toggle-container">
                                            <i class="fa-solid fa-shuffle toggle-compare" onclick="toggleCompare(this)"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="toggle-container">
                                            <i class="fa-solid fa-share-nodes toggle-share" onclick="toggleShare(this)"></i>
                                        </a>
                                    </div>
                                </div>
                                <h5 class="card-title">Optometri</h5>
                                <div class="mb-2 d-flex justify-content-between">
                                    <div><span class="rating-stars">★★★★★</span>
                                        <span>(260)</span>
                                    </div>
                                    <span>Diyetisyen</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur nibh ut massa.</p>
                                <div class="features">
                                    <div><i class="bi bi-telephone"></i><a href="tel:+901234567890">Telefon Numarası</a>
                                    </div>
                                    <div><i class="bi bi-globe"></i><a href="https://example.com" target="_blank">Web
                                            Sitesi</a></div>
                                    <div><i class="bi bi-clock"></i><a href="#">Çalışma Saati</a></div>
                                    <div><i class="bi bi-geo-alt"></i><a href="#">Adres Bilgisi</a></div>
                                </div>
                                <button class="btn details-button w-100 mt-3"
                                    onclick="location.href='{{ url('pages/details') }}'">Detaylar</button>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 sc1-card hvr-glow">
                            <img src="{{ asset('assets/img/600x400.png') }}" class="card-img-top" alt="Odyoloji">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-success"><i class="bi bi-circle-fill me-1"></i>Açık</span>
                                    <div class="no-style d-flex gap-2">
                                        <a href="javascript:void(0);" class="toggle-container">
                                            <i class="fa-regular fa-heart toggle-heart" onclick="toggleHeart(this)"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="toggle-container">
                                            <i class="fa-solid fa-shuffle toggle-compare" onclick="toggleCompare(this)"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="toggle-container">
                                            <i class="fa-solid fa-share-nodes toggle-share" onclick="toggleShare(this)"></i>
                                        </a>
                                    </div>
                                </div>
                                <h5 class="card-title">Odyoloji</h5>
                                <div class="mb-2 d-flex justify-content-between">
                                    <div><span class="rating-stars">★★★★☆</span>
                                        <span>(198)</span>
                                    </div>
                                    <span>Kardiyolog</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur nibh ut massa.</p>
                                <div class="features">
                                    <div><i class="bi bi-telephone"></i><a href="tel:+901234567891">Telefon Numarası</a>
                                    </div>
                                    <div><i class="bi bi-globe"></i><a href="https://example.com" target="_blank">Web
                                            Sitesi</a></div>
                                    <div><i class="bi bi-clock"></i><a href="#">Çalışma Saati</a></div>
                                    <div><i class="bi bi-geo-alt"></i><a href="#">Adres Bilgisi</a></div>
                                </div>
                                <button class="btn details-button w-100 mt-3"
                                    onclick="location.href='{{ url('pages/details') }}'">Detaylar</button>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 sc1-card hvr-glow">
                            <img src="{{ asset('assets/img/600x400.png') }}" class="card-img-top" alt="Diyetisyen">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-danger"><i class="bi bi-circle-fill me-1"></i>Kapalı</span>
                                    <div class="no-style d-flex gap-2">
                                        <a href="javascript:void(0);" class="toggle-container">
                                            <i class="fa-regular fa-heart toggle-heart" onclick="toggleHeart(this)"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="toggle-container">
                                            <i class="fa-solid fa-shuffle toggle-compare"
                                                onclick="toggleCompare(this)"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="toggle-container">
                                            <i class="fa-solid fa-share-nodes toggle-share"
                                                onclick="toggleShare(this)"></i>
                                        </a>
                                    </div>
                                </div>
                                <h5 class="card-title">Diyetisyen</h5>
                                <div class="mb-2 d-flex justify-content-between">
                                    <div><span class="rating-stars">★★★★☆</span>
                                        <span>(214)</span>
                                    </div>
                                    <span>Psikoterapist</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur nibh ut massa.</p>
                                <div class="features">
                                    <div><i class="bi bi-telephone"></i><a href="tel:+901234567892">Telefon Numarası</a>
                                    </div>
                                    <div><i class="bi bi-globe"></i><a href="https://example.com" target="_blank">Web
                                            Sitesi</a></div>
                                    <div><i class="bi bi-clock"></i><a href="#">Çalışma Saati</a></div>
                                    <div><i class="bi bi-geo-alt"></i><a href="#">Adres Bilgisi</a></div>
                                </div>
                                <button class="btn details-button w-100 mt-3"
                                    onclick="location.href='{{ url('pages/details') }}'">Detaylar</button>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 sc1-card hvr-glow">
                            <img src="{{ asset('assets/img/600x400.png') }}" class="card-img-top" alt="Diş Hekimliği">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-success"><i class="bi bi-circle-fill me-1"></i>Açık</span>
                                    <div class="no-style d-flex gap-2">
                                        <a href="javascript:void(0);" class="toggle-container">
                                            <i class="fa-regular fa-heart toggle-heart" onclick="toggleHeart(this)"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="toggle-container">
                                            <i class="fa-solid fa-shuffle toggle-compare"
                                                onclick="toggleCompare(this)"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="toggle-container">
                                            <i class="fa-solid fa-share-nodes toggle-share"
                                                onclick="toggleShare(this)"></i>
                                        </a>
                                    </div>
                                </div>
                                <h5 class="card-title">Diş Hekimliği</h5>
                                <div class="mb-2 d-flex justify-content-between">
                                    <div><span class="rating-stars">★★★★☆</span>
                                        <span>(314)</span>
                                    </div>
                                    <span>Fizyoterapist</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur nibh ut massa.</p>
                                <div class="features">
                                    <div><i class="bi bi-telephone"></i><a href="tel:+901234567893">Telefon Numarası</a>
                                    </div>
                                    <div><i class="bi bi-globe"></i><a href="https://example.com" target="_blank">Web
                                            Sitesi</a></div>
                                    <div><i class="bi bi-clock"></i><a href="#">Çalışma Saati</a></div>
                                    <div><i class="bi bi-geo-alt"></i><a href="#">Adres Bilgisi</a></div>
                                </div>
                                <button class="btn details-button w-100 mt-3"
                                    onclick="location.href='{{ url('pages/details') }}'">Detaylar</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
