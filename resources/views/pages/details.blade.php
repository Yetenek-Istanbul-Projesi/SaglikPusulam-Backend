@extends('layouts.master')

@section('title', 'Hizmet Detayları')
@section('main-attr', 'class="start details-main"')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="media col-md-6 col-lg-5 ">
                <nav aria-label="breadcrumb" style="padding:2rem;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('index') }}" class="text-decoration-none">Ana Sayfa</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url('pages/details') }}" class="text-primary">Hizmet
                                Detayları</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col">
                <h1 class="text-left mt-3 ml-2">Hizmet Detayları</h1>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <!-- Galeri -->
                    <div class="media col-xl-5 col-12 ">
                        <!-- Büyük Resim -->
                        <div class="text-center">
                            <img id="mainImage"
                                src="{{ asset('assets/img/bakirkoy-dr-sadi-konuk-egitim-ve-arastirma-hastanesi.jpg') }}"
                                alt="Main Image" class="img-fluid mx-auto d-block">
                        </div>

                        <!-- Küçük Resimler -->
                        <div class="thumbnail-container">
                            <img class="thumbnail" src="{{ asset('assets/img/acibadem-1024x640-67937208390ef.webp') }}"
                                alt="Thumbnail 1"
                                onclick="changeImage('{{ asset('assets/img/acibadem-1024x640-67937208390ef.webp') }}')">
                            <img class="thumbnail" src="{{ asset('assets/img/acibadem-6793720827950.webp') }}"
                                alt="Thumbnail 2"
                                onclick="changeImage('{{ asset('assets/img/acibadem-6793720827950.webp') }}')">
                            <img class="thumbnail"
                                src="{{ asset('assets/img/taksim-egitim-arastirma-hastanesi-6793727b8b894.webp') }}"
                                alt="Thumbnail 3"
                                onclick="changeImage('{{ asset('assets/img/taksim-egitim-arastirma-hastanesi-6793727b8b894.webp') }}')">
                            <img class="thumbnail"
                                src="{{ asset('assets/img/bakirkoy-dr-sadi-konuk-egitim-ve-arastirma-hastanesi-679372092eb35.webp') }}"
                                alt="Thumbnail 4"
                                onclick="changeImage('{{ asset('assets/img/bakirkoy-dr-sadi-konuk-egitim-ve-arastirma-hastanesi-679372092eb35.webp') }}')">
                        </div>
                    </div>

                    <!-- Hakkımızda Detay -->
                    <div class="about col-xl-7 col-12 ">
                        <div class="card border-0">
                            <div class="">
                                <h2 class="text-center mt-2">Acıbadem</h2>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-2" style="padding-left: 30px;">
                                    <span class="badge bg-success"><i class="bi bi-circle-fill me-1"></i>Açık</span>
                                </div>

                                <div class="col-md-6 d-flex flex-row justify-content-start">
                                    <span class="me-2 ">Hastane Puanı:</span>
                                    <span class="text-warning me-2">
                                        <!-- Yıldız sayısı -->
                                        &#9733; &#9733; &#9733; &#9733; &#9733;
                                    </span>
                                    <span>(137 Değerlendirme)</span>
                                </div>

                                <div class="no-style d-flex gap-2 col-md-4 justify-content-end">
                                    <a href="javascript:void(0);" class="toggle-container">
                                        <i class="fa-regular fa-heart toggle-heart" style="font-size: 25px;"
                                            onclick="toggleHeart(this)"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="toggle-container">
                                        <i class="fa-solid fa-shuffle toggle-compare" style="font-size: 25px;"
                                            onclick="toggleCompare(this)"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="toggle-container">
                                        <i class="fa-solid fa-share-nodes toggle-share" style="font-size: 25px;"
                                            onclick="toggleShare(this)"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <p class="col-md-6 card-text p-4">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero fuga necessitatibus
                                    tempora, laborum asperiores sunt aspernatur vel ullam doloremque saepe tenetur rerum
                                    quasi quos facilis molestiae velit, eaque sequi reprehenderit placeat! Quam, laboriosam
                                    similique distinctio laborum tempora, aliquam voluptate error, cumque quisquam rerum
                                    eaque rem vel quae iste repudiandae accusamus cupiditate ipsa odio velit! Ipsum, magni
                                    vitae, repudiandae repellendus eius akdn rerum quasi quos facilis.
                                </p>

                                <!-- Map verisi -->
                                <div class="col-md-6">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2560.112411739545!2d29.27552315694627!3d40.90275219281155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cadb0875f19b45%3A0x32d4dae8021a39d8!2s%C4%B0stanbul%20Gedik%20%C3%9Cniversitesi%20Halil%20Kaya%20Gedik%20Kamp%C3%BCs%C3%BC!5e1!3m2!1str!2str!4v1736258585777!5m2!1str!2str"
                                        width="100%" style="border: 0; height: 300px;" allowfullscreen=""
                                        loading="lazy"></iframe>
                                </div>
                            </div>
                            <div class="row mt-5 m-lg-4">
                                <div class="col-md-4">
                                    <ul class="list-unstyled">
                                        <li class="d-flex align-items-center mb-4">
                                            <img src="{{ asset('assets/img/mingcute_phone-fill.png') }}" alt=""
                                                style="width: 25px; height: 25px" />
                                            <span class="ms-2">0555-555-55-55</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-4">
                                            <img src="{{ asset('assets/img/mdi_archive-time.png') }}" alt=""
                                                style="width: 25px; height: 25px" />
                                            <span class="ms-2">Pazartesi - Cuma 09:00-17:00</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-unstyled">
                                        <li class="d-flex align-items-center mb-4">
                                            <img src="{{ asset('assets/img/mdi_web.png') }}" alt=""
                                                style="width: 25px; height: 25px" />
                                            <span class="ms-2">(Web sitesi buraya gelecek)</span>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <img src="{{ asset('assets/img/mdi_address-marker.png') }}" alt=""
                                                style="width: 25px; height: 25px" />
                                            <span class="ms-2">(Adres bilgisi buraya gelecek)</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col">
                                    <button class="btn btn-outline-primary mb-3 me-2 w-100">Yol Tarifi</button>
                                    <button class="btn btn-primary text-white btn-lg mb-3 me-2 w-100">Randevu Al</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Yorumlar -->
        <div class="container-fluid">
            <div class="col mt-3">
                <h1 class="reviews-title mt-5">Değerlendirmeler</h1>
                <div id="commentsLoader" class="text-center py-4 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Yükleniyor...</span>
                    </div>
                </div>
                <div class="comments-list">
                    <div class="review-card">
                        <div class="review-header">
                            <div class="avatar">
                                <img src="{{ asset('assets/img/Ellipse 18.png') }}" alt="User Avatar">
                            </div>
                            <div class="name">D**** B**</div>
                            <div class="time">2 dakika önce</div>
                        </div>
                        <div class="review-body">
                            Lorem ipsum dolor sit amet consectetur. Cras sit nunc elementum porttitor id sit lacus commodo
                            cras. Hendrerit adipiscing faucibus dui at.
                        </div>
                        <div class="review-footer">
                            <div class="rating">&#9733;&#9733;&#9733;&#9733;&#9734;</div>
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="review-header">
                            <div class="avatar">
                                <img src="{{ asset('assets/img/Ellipse 15.png') }}" alt="User Avatar">
                            </div>
                            <div class="name">M**** Y*****</div>
                            <div class="time">6 dakika önce</div>
                        </div>
                        <div class="review-body">
                            Lorem ipsum dolor sit amet consectetur. Cras sit nunc elementum porttitor id sit lacus commodo
                            cras. Hendrerit adipiscing faucibus dui at.
                        </div>
                        <div class="review-footer">
                            <div class="rating">&#9733;&#9733;&#9733;&#9733;&#9734;</div>
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="review-header">
                            <div class="avatar">
                                <img src="{{ asset('assets/img/Ellipse 16.png') }}" alt="User Avatar">
                            </div>
                            <div class="name">S**** V***</div>
                            <div class="time">15 dakika önce</div>
                        </div>
                        <div class="review-body">
                            Lorem ipsum dolor sit amet consectetur. Cras sit nunc elementum porttitor id sit lacus commodo
                            cras. Hendrerit adipiscing faucibus dui at.
                        </div>
                        <div class="review-footer">
                            <div class="rating">&#9733;&#9733;&#9733;&#9733;&#9734;</div>
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="review-header">
                            <div class="avatar">
                                <img src="{{ asset('assets/img/Ellipse 17.png') }}" alt="User Avatar">
                            </div>
                            <div class="name">E** Z****</div>
                            <div class="time">6 saat önce</div>
                        </div>
                        <div class="review-body">
                            Lorem ipsum dolor sit amet consectetur. Cras sit nunc elementum porttitor id sit lacus commodo
                            cras. Hendrerit adipiscing faucibus dui at.
                        </div>
                        <div class="review-footer">
                            <div class="rating">&#9733;&#9733;&#9733;&#9733;&#9734;</div>
                        </div>
                    </div>
                </div>
                <nav aria-label="Sayfalama">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" onclick="return showCommentsLoading();"
                                aria-label="Previous">
                                <span aria-hidden="true">&larr;</span>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#" onclick="return showCommentsLoading();">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" onclick="return showCommentsLoading();">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" onclick="return showCommentsLoading();">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" onclick="return showCommentsLoading();"
                                aria-label="Next">
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
