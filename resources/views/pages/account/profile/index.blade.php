@extends('layouts.master')

@section('title', 'Profil Bilgileri')
@section('styles')
    <link href="{{ asset('css/pages/profile/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="wrapper" class="container" style="padding-left: 25px;">
        <div class="row">
            <div class="col-12 col-xl-5 col-md-4 d-flex" style="height: 100vh;" id="left-content">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('assets/img/Rectangle 48.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="#" class="card-link">
                            <p style="text-align: center;">Fotoğrafı Değiştir</p>
                        </a>
                        <h5 class="card-title" style="text-align: center;">Ad Soyad</h5>
                    </div>

                    <a href="{{ url('account/profile/index') }}" class="btn btn-primary btn-lg">Profil Bilgileri</a></br>
                    <a href="{{ url('account/profile/favorite-list') }}"
                        class="btn btn-outline-primary btn-lg">Favoriler</a></br>
                    <a href="{{ url('account/profile/security') }}" class="btn btn-outline-primary btn-lg">Güvenlik</a></br>
                    <a href="{{ url('account/profile/compare-list') }}" class="btn btn-outline-primary btn-lg">Karşılaştırma
                        Listesi</a></br>
                    <a href="javascript:void(0);" class="btn btn-outline-primary btn-lg">Çıkış Yap</a></br>
                </div>
            </div>
            <div class="container-fluid col-12 col-xl-7 col-lg-8 min-vh-100" style="padding-left: 23px;" id="right-content">
                <div class="search-title mb-3">
                    <h4>Profil Bilgileri</h4>
                </div>
                <div class="page-display" style="width: 900px;">
                    <div class="row g-0">
                        <div class="col">
                            <div class="container p-5">
                                <form class="needs-validation" novalidate onsubmit="handleProfileUpdateForm(event)">
                                    <!-- Ad ve Soyad -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Ad</label>
                                                <input type="text" class="form-control bgc" id="name"
                                                    placeholder="Ad" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="surname" class="form-label">Soyad</label>
                                                <input type="text" class="form-control bgc" id="surname"
                                                    placeholder="Soyad" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- E-Posta ve Telefon Numarası -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="profile-email" class="form-label">E-Posta</label>
                                                <input type="email" class="form-control bgc" id="profile-email"
                                                    name="profile-email" placeholder="E-Posta" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="profile-number" class="form-label">Telefon Numarası</label>
                                                <input type="tel" class="form-control bgc" id="profile-number"
                                                    name="profile-number" placeholder="Telefon Numarası" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Adres Bilgisi -->
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="textarea" class="form-label">Adres Bilgisi</label>
                                                <textarea id="textarea" class="form-control bgc" name="profile-address" placeholder="Adres Bilgisi" rows="4"
                                                    required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100">Değişiklikleri
                                                Kaydet</button>
                                        </div>
                                    </div>
                                    <!-- Kaydet Butonu -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
