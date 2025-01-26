@extends('layouts.master')

@section('title', 'Hesap Oluştur')
@section('body-attr', 'class="bg-whites"')

@section('content')
        <div class="container-fluid p-0">
            <img src="{{ asset('assets/img/banner_photo.jpg') }}" alt="" style="width: 100%;">
        </div>
        <div class="start container d-flex align-items-center justify-content-center">
            <div style="min-width: 600px; max-width: 1000px;">
                <div class="p-5">
                    <h5 class="card-title">Hesap Oluştur</h5>
                    <form class="needs-validation" novalidate onsubmit="handleRegisterForm(event)">
                        <div class="row mb-3 mt-5">
                            <div class="col">
                                <label for="name" class="form-label">Ad</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="col">
                                <label for="surname" class="form-label">Soyad</label>
                                <input type="text" class="form-control" id="surname" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-posta</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Şifre</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Şifreyi Onayla</label>
                            <input type="password" class="form-control" id="confirmPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Kaydol</button>
                    </form>
                    <div class="text-center mb-5">
                        <span class="text-muted">Zaten hesabın var mı?</span>
                        <a href="{{ url('/account/login') }}" class="text-decoration-none">Giriş Yap</a>
                    </div>
                </div>
            </div>
        </div>
@endsection
