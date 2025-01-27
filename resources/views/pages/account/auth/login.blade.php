@extends('layouts.master')

@section('title', 'Giriş Yap')
@section('body-attr', 'class="bg-whites"')

@section('content')
    <div class="container-fluid p-0">
        <img src="{{asset('assets/img/banner_photo.jpg')}}" alt="" style="width: 1400%;">
    </div>
    <div class="start container d-flex justify-content-center">
        <!-- Login formu container'ı - minimum ve maximum genişlik sınırlaması -->
        <div style="min-width: 400px; max-width: 1000px;">
            <div class="p-5">
                <!-- Form başlığı -->
                <h2 class="text-center text-primary fw-bold mb-4" style="margin: 50px 0px 80px 0px;">Giriş Yap</h2>
                <form class="needs-validation" novalidate onsubmit="handleLoginForm(event)">

                    <!-- E-mail input  -->
                    <div class="mb-3">
                        <label for="emailPhone" class="form-label" style="border: none; text-align: left;">E-posta / Telefon
                            Numarası</label>
                        <input type="text" class="form-control border-0 bg-secondary-subtle text-secondary" id="emailPhone"
                               placeholder="E-posta / Telefon Numarası" style="height: 50px; margin-bottom: 20px;" required>
                    </div>

                    <!-- Şifre  -->
                    <div class="mb-3">
                        <label for="password" class="form-label" style="border: none; text-align: left;">Şifre (*)</label>
                        <input type="password" class="form-control border-0 bg-secondary-subtle text-secondary" id="password"
                               placeholder="Şifre(*)" style="height: 50px; margin-bottom: 20px;" required>
                    </div>

                    <!-- Giriş butonu
                                   w-100: Tam genişlik -->
                    <button type="submit" class="btn btn-primary w-100 mb-3" style="margin-top: 30px; height: 50px;">Giriş
                        Yap</button>

                </form>
            </div>
        </div>
    </div>

    <!-- Kayıt ol yönlendirmesi -->
    <div class="text-center mb-3">
        <span class="text-muted">Hesabınız yok mu?</span>
        <a href="{{url('/register')}}" class="text-decoration-none">Hemen Kaydolun</a>
    </div>
    <div class="text-center mb-3">
        <span class="text-muted">Şifrenizi mi unuttunuz?</span>
        <a href="{{url('/forgot-password')}}" class="text-decoration-none">Şifremi Unuttum</a>
    </div>

    <!-- Sosyal medya butonları bölümü -->
    <div class="text-center mt-5">
        <!-- Sosyal medya butonları container'ı d-flex: Flexbox kullanımı justify-content-center: Yatay ortalama -->
        <div class="d-flex justify-content-center">
            <!-- LinkedIn butonu -->
            <a href="#" class="social-btn linkedin">
                <img src="{{asset('assets/img/devicon_linkedin.png')}}" alt="LinkedIn" style="width: 20px; height: 20px;">
            </a>
            <!-- Google butonu -->
            <a href="#" class="social-btn google">
                <img src="{{asset('assets/img/flat-color-icons_google.png')}}" alt="Google"
                     style="width: 20px; height: 20px;">
            </a>
            <!-- Facebook butonu -->
            <a href="#" class="social-btn facebook">
                <img src="{{asset('assets/img/logos_facebook.png')}}" alt="Facebook" style="width: 20px; height: 20px;">
            </a>
        </div>
    </div>
@endsection
