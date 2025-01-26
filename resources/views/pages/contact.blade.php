@extends('layouts.master')

@section('title', 'İletişim')

@section('content')
    <section>
        <div class="section-photo">
            <img src="{{ asset('assets/img/banner_photo.jpg') }}" alt=""
                style="margin: 0px 10px 50px 0px; width: 100%;">
        </div>
    </section>

    <div class="start container d-flex justify-content-center">
        <!-- Login formu container'ı - minimum ve maximum genişlik sınırlaması -->
        <div style="min-width: 400px; max-width: 1000px;">
            <div class="p-5">
                <!-- Form başlığı -->
                <h2 class="text-center text-primary fw-bold mb-4" style="margin: 20px 0px 0px 0px;">İletişim</h2>
                <form id="contactForm" onsubmit="handleFormSubmit(event, 'contactForm')">
                    <!-- Ad - Soyad input -->
                    <div class="mb-3">
                        <label for="name" class="form-label"
                            style="margin-top: 50px; border: none; text-align: left;">Ad - Soyad</label>
                        <input type="text" required class="form-control border-0 bg-secondary-subtle text-secondary"
                            id="name" placeholder="Ad - Soyad"
                            style="height: 50px; width: 500px; margin-bottom: 20px;">
                    </div>

                    <!-- E-mail input -->
                    <div class="mb-3">
                        <label for="email" class="form-label"
                            style="margin-top: 20px; border: none; text-align: left;">E-mail</label>
                        <input type="email" required class="form-control border-0 bg-secondary-subtle text-secondary"
                            id="email" placeholder="E-mail" style="height: 50px; margin-bottom: 20px;">
                    </div>

                    <!-- Mesaj input -->
                    <div class="mb-3">
                        <label for="message" class="form-label"
                            style="margin-top: 20px; border: none; text-align: left;">Mesaj</label>
                        <textarea class="form-control border-0 bg-secondary-subtle w-100" id="message" required placeholder="Mesaj"
                            style="height: 200px; text-align: left; vertical-align: top;"></textarea>
                    </div>

                    <!-- Gönder butonu -->
                    <button type="submit" class="btn btn-primary w-100 mb-3"
                        style="margin-top: 30px; height: 50px;">Gönder</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bize ulaşın mesajının alanı. -->
    <section class="contact-info">
        <div class="contact-info" style="position: relative; display: inline-block;">
            <img src="{{ asset('assets/img/Rectangle 86.png') }}" alt="" class="w-100">
            <p class="overlay-text">Soru ve sorunlarınız için saglikpusulam@gov.tr adresimizi kullanarak bize
                ulaşabilirsiniz.</p>
        </div>
    </section>
@endsection
