@extends('layouts.master')

@section('title', 'Favoriler')
@section('styles')
    <link href="{{ asset('css/pages/profile/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="wrapper" class="container">
        <div class="row">

            <!-- Sol Taraf -->
            <div class="col-12 col-xl-4 col-md-4 d-flex" style="height: 100vh;" id="left-content">
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
                    <a href="{{ url('account/profile/favorite-list') }}" class="btn btn-primary btn-lg">Favoriler</a></br>
                    <a href="{{ url('account/profile/security') }}" class="btn btn-outline-primary btn-lg">Güvenlik</a></br>
                    <a href="{{ url('account/profile/compare-list') }}" class="btn btn-outline-primary btn-lg">Karşılaştırma
                        Listesi</a></br>
                    <a href="javascript:void(0);" class="btn btn-outline-primary btn-lg">Çıkış Yap</a></br>
                </div>
            </div>

            <!-- Sağ Taraf -->
            <div class="container-fluid col-12 col-xl-8 col-md-8" id="right-content">
                <div class="search-title mb-3">
                    <h4>Favoriler</h4>
                </div>
                <div class="search-results favorite-cards">
                    <!-- Cards -->
                    <div class="hospital-card card mb-4 border rounded-3 shadow-sm">
                        <div class="row g-0">
                            <div class="col-12 col-xl-3">
                                <img src="{{ asset('assets/img/Memori.jpg') }}"
                                    class="img-fluid rounded-start h-100 object-fit-cover" alt="Memorial Hospital">
                            </div>
                            <div class="col-12 col-xl-9">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
                                        <h5 class="card-title mb-2 mb-md-0">Memorial</h5>
                                        <div class="action-buttons d-flex gap-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div class="no-style d-flex gap-2">
                                                    <a href="javascript:void(0);" class="toggle-container">
                                                        <i class="fa-regular fa-heart toggle-heart action-buttons"
                                                            onclick="toggleHeart(this)"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="toggle-container">
                                                        <i class="fa-solid fa-shuffle toggle-compare action-buttons"
                                                            onclick="toggleCompare(this)"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="toggle-container">
                                                        <i class="fa-solid fa-share-nodes toggle-share action-buttons"
                                                            onclick="toggleShare(this)"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hospital-info d-flex flex-wrap gap-4 mb-3">
                                        <span><i class="fa-regular fa-calendar"></i> Kapalı</span>
                                        <span><i class="fa-solid fa-location-dot"></i> Adres</span>
                                        <span><i class="fa-solid fa-user-doctor"></i> Bölümü</span>
                                    </div>
                                    <p class="card-text mb-3">Lorem ipsum dolor sit amet consectetur. Ut non diam a ut nunc
                                        pulvinar massa.</p>
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                        <div class="rating">
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <span class="ms-2">(137 Değerlendirme)</span>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-outline-primary rounded-pill"
                                                onclick="location.href='{{ url('pages/details') }}'">Detay</button>
                                            <button class="btn btn-primary rounded-pill">Randevu Al</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Diğer hastane kartları burada devam edecek... -->
                </div>
            </div>
        </div>
    </div>
@endsection
