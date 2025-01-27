@extends('layouts.master')

@section('title', 'Yeni Şifre Oluştur')
@section('body-attr', 'class="bg-whites"')

@section('content')
    <div class="container-fluid p-0">
        <img src="{{ asset('assets/img/banner_photo.jpg') }}" alt="" style="width: 100%;">
    </div>
    <div class="start container d-flex justify-content-center">
        <!-- Login formu container'ı - minimum ve maximum genişlik sınırlaması -->
        <div style="min-width: 400px; max-width: 1000px;">
            <div class="p-5">
                <!-- Form başlığı -->
                <h2 class="text-center text-primary fw-bold mb-4" style="margin: 50px 0px 80px 0px;">Yeni Şifre Oluştur</h2>
                <form class="needs-validation" novalidate onsubmit="handleCreateNewPasswordForm(event)">
                    <!-- Yeni Şifre input  -->
                    <div class="mb-3">
                        <label for="new-password" class="form-label" style="border: none; text-align: left;">Yeni
                            Şifre</label>
                        <input type="password" class="form-control border-0 bg-secondary-subtle text-secondary"
                            id="new-password" placeholder="Yeni şifreniz"
                            style="height:50px; width: 500px; margin-bottom: 20px;" required>
                    </div>

                    <!-- Yeni Şifre Tekrar input  -->
                    <div class="mb-3">
                        <label for="new-password-again" class="form-label"
                            style="border: none; text-align: left; margin-top: 20px;">Yeni Şifre Tekrar</label>
                        <input type="password" class="form-control border-0 bg-secondary-subtle text-secondary"
                            id="new-password-again" placeholder="Yeni şifreyi tekrar giriniz"
                            style="height: 50px; margin-bottom: 20px;" required>
                    </div>

                    <!-- Şifreyi Sıfırla butonu -->
                    <button type="submit" class="btn btn-primary w-100 mb-3"
                        style="margin-top: 30px; height: 50px;">Şifreyi
                        Sıfırla</button>
                </form>
            </div>
        </div>
    </div>
@endsection
