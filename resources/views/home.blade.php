@extends('layouts.master')

@section('title', 'Ana Sayfa')

@section('content')
        <!-- AnaSayfa Section 1 - Ana arama bölümü -->
        <section class="start position-relative" style="height: 1000px;">
            <div class="position-absolute w-100" style="z-index: 1; height: 1000px;">
                <img src="{{ asset('assets/img/homepage-section1-bg.png') }}" class="w-100 h-100" style="object-fit: cover"
                     alt="Sağlık Arkaplan">
            </div>
            <div class="position-relative d-flex align-items-center" style="z-index: 2; height: 100%;">
                <div class="container-fluid px-4">
                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-6">
                            <form id="searchForm" onsubmit="return handleSearchForm(event)">
                                <div class="mb-5" style="padding-top: 200px;">
                                    <h1 class="text-primary">Çevrendeki En İyi Sağlık Hizmetini Bul</h1>
                                    <h3 class="text-secondary">Sağlık hizmetleri arasında tercihini yap</h3>
                                </div>

                                <div class="d-flex flex-column flex-lg-row gap-3">
                                    <div class="position-relative" style="display: flex;flex-direction: column;height: 100px;">
                                        <div style="flex-grow: 1; width: 100%; min-width: 400px;">
                                            <div id="firstChain"></div>
                                        </div>

                                        <div class="position-absolute" style="align-self: flex-end; border: none; background: none;">
                                            <img src="{{ asset('assets/img/Group.png') }}" alt="" style="width: 45px; height: 45px;">
                                        </div>
                                    </div>
                                    <div class="position-relative" style="display: flex;flex-direction: column;height: 100px;">
                                        <div style="flex-grow: 1; width: 100%; min-width: 400px;">
                                            <div id="secondChain"></div>
                                        </div>
                                        <div class="position-absolute" style="align-self: flex-end; border: none; background: none;">
                                            <img src="{{ asset('assets/img/Group.png') }}" alt="" style="width: 45px; height: 45px;">
                                        </div>
                                    </div>
                                    <button type="submit"
                                            class="btn btn-primary d-flex align-items-center justify-content-center gap-2 shadow"
                                            style="width: 85px; height: 45px;">
                                        <i class="fa-solid fa-magnifying-glass" style="font-size: 20px;"></i>
                                        Ara
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" style="margin-top: 100px; margin-bottom: 100px;">
            <div class="container-fluid py-5">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="row row-cols-1 row-cols-md-5 g-4 section2-cards">
                            <!-- Kart 1 -->
                            <div class="col">
                                <div class="card h-100">
                                    <img src="{{ asset('assets/img/Group 121.svg') }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Hizmeti Bul</h5>
                                        <p class="card-text">Çevrenizdeki en iyi sağlık hizmetini kolayca keşfedin</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Kart 2 -->
                            <div class="col">
                                <div class="card h-100">
                                    <img src="{{ asset('assets/img/detaylaraBak.svg') }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Detaylara Bak</h5>
                                        <p class="card-text">Sağlık hizmetlerinin hizmet detaylarını, yorumlarını ve konum bilgilerini inceleyin</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Kart 3 -->
                            <div class="col">
                                <div class="card h-100">
                                    <img src="{{ asset('assets/img/iletisimeGec.svg') }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">İletişime Geçin</h5>
                                        <p class="card-text">Sağlık hizmetleriyle hızlıca iletişim kurabileceğiniz bilgileri bulun.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Kart 4 -->
                            <div class="col">
                                <div class="card h-100">
                                    <img src="{{ asset('assets/img/iletisim.svg') }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Hizmetleri Karşılaştırın</h5>
                                        <p class="card-text">Sağlık hizmetlerinin sunduğu hizmetleri kıyaslayarak en iyi seçimi yapın.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Kart 5 -->
                            <div class="col">
                                <div class="card h-100">
                                    <img src="{{ asset('assets/img/HizmetiBul.svg') }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Görüş Bildir</h5>
                                        <p class="card-text">Sağlık hizmetleri hakkında deneyimlerinizi ve yorumlarınızı paylaşarak görüşlerinizi bildirebilirsiniz.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="best-health-services">
            <div class="container">
                <h2 class="text-center mb-5" style="color: #007bff; font-weight: bold;">En Çok Tercih Edilen Sağlık Hizmetleri</h2>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div class="col">
                        <div class="card h-100 sc1-card hvr-glow">
                            <img src="{{ asset('assets/img/300x200.png') }}" class="card-img-top" alt="Optometri">
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
                                    <div><i class="bi bi-telephone"></i><a href="tel:+901234567890">Telefon Numarası</a></div>
                                    <div><i class="bi bi-globe"></i><a href="https://example.com" target="_blank">Web Sitesi</a></div>
                                    <div><i class="bi bi-clock"></i><a href="#">Çalışma Saati</a></div>
                                    <div><i class="bi bi-geo-alt"></i><a href="#">Adres Bilgisi</a></div>
                                </div>
                                <button class="btn details-button w-100 mt-3" onclick="location.href={{ url('/pages/details') }}">Detaylar</button>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 sc1-card hvr-glow">
                            <img src="{{ asset('assets/img/300x200.png') }}" class="card-img-top" alt="Odyoloji">
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
                                    <div><i class="bi bi-telephone"></i><a href="tel:+901234567891">Telefon Numarası</a></div>
                                    <div><i class="bi bi-globe"></i><a href="https://example.com" target="_blank">Web Sitesi</a></div>
                                    <div><i class="bi bi-clock"></i><a href="#">Çalışma Saati</a></div>
                                    <div><i class="bi bi-geo-alt"></i><a href="#">Adres Bilgisi</a></div>
                                </div>
                                <button class="btn details-button w-100 mt-3" onclick="location.href='{{ url('pages/details') }}'">Detaylar</button>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 sc1-card hvr-glow">
                            <img src="{{ asset('assets/img/300x200.png') }}" class="card-img-top" alt="Diyetisyen">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-danger"><i class="bi bi-circle-fill me-1"></i>Kapalı</span>
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
                                <h5 class="card-title">Diyetisyen</h5>
                                <div class="mb-2 d-flex justify-content-between">
                                    <div><span class="rating-stars">★★★★☆</span>
                                        <span>(214)</span>
                                    </div>
                                    <span>Psikoterapist</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur nibh ut massa.</p>
                                <div class="features">
                                    <div><i class="bi bi-telephone"></i><a href="tel:+901234567892">Telefon Numarası</a></div>
                                    <div><i class="bi bi-globe"></i><a href="https://example.com" target="_blank">Web Sitesi</a></div>
                                    <div><i class="bi bi-clock"></i><a href="#">Çalışma Saati</a></div>
                                    <div><i class="bi bi-geo-alt"></i><a href="#">Adres Bilgisi</a></div>
                                </div>
                                <button class="btn details-button w-100 mt-3" onclick="location.href='{{ url('pages/details') }}'">Detaylar</button>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 sc1-card hvr-glow">
                            <img src="{{ asset('assets/img/300x200.png') }}" class="card-img-top" alt="Diş Hekimliği">
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
                                <h5 class="card-title">Diş Hekimliği</h5>
                                <div class="mb-2 d-flex justify-content-between">
                                    <div><span class="rating-stars">★★★★☆</span>
                                        <span>(314)</span>
                                    </div>
                                    <span>Fizyoterapist</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur nibh ut massa.</p>
                                <div class="features">
                                    <div><i class="bi bi-telephone"></i><a href="tel:+901234567893">Telefon Numarası</a></div>
                                    <div><i class="bi bi-globe"></i><a href="https://example.com" target="_blank">Web Sitesi</a></div>
                                    <div><i class="bi bi-clock"></i><a href="#">Çalışma Saati</a></div>
                                    <div><i class="bi bi-geo-alt"></i><a href="#">Adres Bilgisi</a></div>
                                </div>
                                <button class="btn details-button w-100 mt-3" onclick="location.href='{{ url('pages/details') }}'">Detaylar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section id="contact-section" style="margin-top: 100px; margin-bottom: 100px;">
            <div class="container">
                <i class="bi bi-chat-dots" style="font-size: 40px; color: #007bff;"></i>
                <h2>Yardıma İhtiyacınız mı Var?</h2>
                <p>Sorularınız varsa müşteri destek ekibimizle iletişime geçin.<br>Sizlere yardımcı olmaya hazırız.</p>
                <a href="mailto:support@example.com">Mail Göndermek İstiyorum</a>
            </div>
        </section>
@endsection
