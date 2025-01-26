@extends('layouts.master')

@section('title', 'Güvenlik')
@section('styles')
    <link href="{{ asset('css/pages/profile/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="wrapper" class="container" style="padding-left: 24px;">
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

                    <a href="{{ url('account/profile/index') }}" class="btn btn-outline-primary btn-lg">Profil
                        Bilgileri</a></br>
                    <a href="{{ url('account/profile/favorite-list') }}" class="btn btn-outline-primary btn-lg">Favoriler</a></br>
                    <a href="{{ url('account/profile/security') }}" class="btn btn-primary btn-lg">Güvenlik</a></br>
                    <a href="{{ url('account/profile/compare-list') }}" class="btn btn-outline-primary btn-lg">Karşılaştırma
                        Listesi</a></br>
                    <a href="javascript:void(0);" class="btn btn-outline-primary btn-lg">Çıkış Yap</a></br>
                </div>
            </div>
            <div class="container-fluid col-12 col-xl-7 col-lg-8 min-vh-100" style="padding-left: 24px;" id="right-content">
                <div class="search-title mb-3">
                    <h4>Güvenlik</h4>
                </div>
                <div class="page-display container" style="width: 900px;">
                    <div class="container p-5">
                        <form class="needs-validation" novalidate onsubmit="handleSecuritySettingsForm(event)">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <div class="mb-4">
                                        <label for="password" class="mb-2">Mevcut Şifre</label>
                                        <input type="password" class="form-control bgc w-100" id="password"
                                            placeholder="Mevcut Şifre" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-4">
                                        <label for="new-password" class="mb-2">Yeni Şifre(*)</label>
                                        <input type="password" class="form-control bgc w-100" id="new-password"
                                            placeholder="Yeni Şifre" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-4">
                                        <label for="confirm-password" class="mb-2">Yeni Şifre Tekrar(*)</label>
                                        <input type="password" class="form-control bgc w-100" id="confirm-password"
                                            placeholder="Yeni Şifre Tekrar" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary w-100">Değişiklikleri Kaydet</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
