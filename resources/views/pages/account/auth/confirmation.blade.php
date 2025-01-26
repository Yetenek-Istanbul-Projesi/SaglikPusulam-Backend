@extends('layouts.master')

@section('title', 'Hesabını Onayla')

@section('content')
    <section>
        <div class="section-photo">
            <img src="{{ asset('assets/img/banner_photo.jpg') }}" alt="" style="width: 100%;">
        </div>
    </section>
    <div class="start container d-flex justify-content-center">
        <!-- Login formu container'ı - minimum ve maximum genişlik sınırlaması -->
        <div style="min-width: 400px; max-width: 1000px;">
            <div class="p-5">
                <!-- Form başlığı -->
                <h2 class="text-center text-primary fw-bold mb-4" style="margin: 50px 0px 80px 0px;">Onay Kodu</h2>
                <form class="needs-validation" novalidate onsubmit="handleConfirmationForm(event)">
                    <!-- E-mail Onay Kodu input  -->
                    <div class="mb-3">
                        <label for="email-code" class="form-label"
                            style="margin-top: 50px; border: none; text-align: left;">E-mail Onay Kodu</label>
                        <input type="text" class="form-control border-0 bg-secondary-subtle text-secondary"
                            id="email-code" placeholder="E-mail onay kodunuz"
                            style="height: 50px; width: 500px; margin-bottom: 20px;" required>
                    </div>

                    <!-- Cep telefonu onay kodunuz input  -->
                    <div class="mb-3">
                        <label for="phone-code" class="form-label"
                            style="margin-top: 20px; border: none; text-align: left;">Cep Telefonu Onay Kodu</label>
                        <input type="text" class="form-control border-0 bg-secondary-subtle text-secondary"
                            id="phone-code" placeholder="Cep telefonu onay kodunuz"
                            style="height: 50px; margin-bottom: 20px;" required>
                    </div>

                    <!-- Onayla butonu -->
                    <button type="submit" class="btn btn-primary w-100 mb-3"
                        style="margin-top: 30px; height: 50px;">Onayla</button>
                </form>
            </div>
        </div>
    </div>
@endsection
