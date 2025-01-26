@extends('layouts.master')

@section('title', 'Şifremi Unuttum')
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
                <h2 class="text-center text-primary fw-bold mb-4" style="margin: 50px 0px 80px 0px;">Parolamı Unuttum</h2>
                <form class="needs-validation" novalidate onsubmit="handleForgotPasswordForm(event)">
                    <!-- E-mail - Phone input  -->
                    <div class="mb-3">
                        <label for="emailPhone" class="form-label" style="border: none; text-align: left;">E-posta / Cep
                            Telefonu</label>
                        <input type="text" class="form-control border-0 bg-secondary-subtle text-secondary"
                            id="emailPhone" placeholder="E-posta ya da Cep Telefonu giriniz.."
                            style="height:50px; width: 500px; margin-bottom: 20px;" required>
                    </div>

                    <!-- Giriş butonu -->
                    <button type="submit" class="btn btn-primary w-100 mb-3" style="margin-top: 30px; height: 50px;">Devam
                        Et</button>
                </form>
            </div>
        </div>
    </div>
@endsection
