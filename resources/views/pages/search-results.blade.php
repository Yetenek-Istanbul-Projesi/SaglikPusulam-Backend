@extends('layouts.master')

@section('title', 'Arama Sonuçları')
@section('main-attr', 'class="search-results-container py-4"')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Filtreleme Bölümü -->
            <div class="col-lg-3 col-md-4 mb-4">
                <!-- Navigation -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('index') }}" class="text-decoration-none">Ana Sayfa</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#" class="text-primary">Sağlık Hizmetleri</a></li>
                    </ol>
                </nav>

                <!-- Filtreleme -->
                <div class="filter-card card border-0 bg-white shadow-sm rounded-3">
                    <div class="card-body">
                        <!-- Puan -->
                        <div class="filter-section">
                            <h6 class="filter-title">Puan</h6>
                            <div class="rating-filters input-group">
                                <div class="form-check" data-stars="1">
                                    <input type="radio" name="rating" class="form-check-input" id="star1">
                                    <label class="form-check-label rating-label" for="star1">
                                        <i class="fa-solid fa-star text-warning"></i>
                                    </label>
                                </div>
                                <div class="form-check" data-stars="2">
                                    <input type="radio" name="rating" class="form-check-input" id="star2">
                                    <label class="form-check-label rating-label" for="star2">
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                    </label>
                                </div>
                                <div class="form-check" data-stars="3">
                                    <input type="radio" name="rating" class="form-check-input" id="star3">
                                    <label class="form-check-label rating-label" for="star3">
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                    </label>
                                </div>
                                <div class="form-check" data-stars="4">
                                    <input type="radio" name="rating" class="form-check-input" id="star4">
                                    <label class="form-check-label rating-label" for="star4">
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                    </label>
                                </div>
                                <div class="form-check" data-stars="5">
                                    <input type="radio" name="rating" class="form-check-input" id="star5">
                                    <label class="form-check-label rating-label" for="star5">
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Mesafe -->
                        <div class="filter-section">
                            <h6 class="filter-title">Mesafe</h6>
                            <div class="distance-slider px-2">
                                <input type="range" class="form-range" id="distanceRange" min="1" max="10"
                                    step="1" value="3">
                                <div class="d-flex justify-content-between mt-2">
                                    <span class="small text-muted">1km</span>
                                    <span class="small text-muted" id="rangeValue">3km</span>
                                    <span class="small text-muted">10km</span>
                                </div>
                            </div>
                        </div>

                        <!-- Hizmet İsmi -->
                        <div class="filter-section">
                            <h6 class="filter-title">Hizmet Ara</h6>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="text" class="form-control" id="serviceName" placeholder="Hizmet ara...">
                            </div>
                        </div>

                        <!-- Hizmet Durumu -->
                        <div class="filter-section">
                            <h6 class="filter-title">Hizmet Durumu</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="serviceStatus">
                                <label class="form-check-label" style="margin-left: 0.5rem" for="serviceStatus">Şuanda
                                    Açık</label>
                            </div>
                        </div>

                        <!-- Detaylı Filtreleme -->
                        <div class="filter-section">
                            <h6 class="filter-title">Detaylı Filtreleme</h6>
                            <div class="detailed-filters">
                                <div class="filter-select-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                        <select class="form-select" aria-label="İl seçimi">
                                            <option selected>İl Seçiniz</option>
                                            <option value="1">İstanbul</option>
                                            <option value="2">Ankara</option>
                                            <option value="3">İzmir</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-select-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                        <select class="form-select" aria-label="İlçe seçimi">
                                            <option selected>İlçe Seçiniz</option>
                                            <option value="1">Kadıköy</option>
                                            <option value="2">Çankaya</option>
                                            <option value="3">Konak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-select-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                        <select class="form-select" aria-label="Uzmanlık seçimi">
                                            <option selected>Uzmanlık Seçiniz</option>
                                            <option value="1">Kardiyoloji</option>
                                            <option value="2">Dahiliye</option>
                                            <option value="3">Ortopedi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sağ Kısım - Arama Sonuçları -->
            <div class="col-lg-9 col-md-8">
                <h2 class="search-title mb-4">Arama Sonuçları</h2>
                <div class="search-results">
                    <!-- Cards -->
                    <div class="hospital-card card mb-4 border rounded-3 shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-3">
                                <img src="{{ asset('assets/img/Memori.jpg') }}"
                                    class="img-fluid rounded-start h-100 object-fit-cover" alt="Memorial Hospital">
                            </div>
                            <div class="col-md-9">
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
                                            <span class="ms-2 text-muted">(137 Değerlendirme)</span>
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
                <div id="loadingMore" class="text-center py-4 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Yükleniyor...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
