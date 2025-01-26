@extends('layouts.master')

@section('title', 'KVKK')
@section('body-attr', 'class="page-body"')
@section('main-attr', 'class="start page-content"')

@section('content')
    <nav aria-label="breadcrumb" style="padding:2rem;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('index') }}" class="text-decoration-none">Ana Sayfa</a></li>
            <li class="breadcrumb-item"><a href="{{ url('pages/kvkk') }}" class="text-primary">KVKK</a></li>
        </ol>
    </nav>
    <div class="container text-center my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-start">
                <h2 class="mb-4">Kişisel Verilerin Korunması Kanunu (KVKK)</h2>

                <div class="text-start">
                    <h5 class="mt-4 mb-3">Amaç ve Kapsam</h5>
                    <p class="mb-4"><b>MADDE 1</b> – (1) Bu Tebliğin amacı, 24/3/2016 tarihli ve 6698 sayılı Kişisel
                        Verilerin Korunması Kanununun 10 uncu maddesi uyarınca veri sorumluları veya yetkilendirdiği
                        kişilerce yerine getirilmesi gereken aydınlatma yükümlülüğü kapsamında uyulacak usul ve esasları
                        belirlemektir.</p>

                    <h5 class="mt-4 mb-3">Dayanak</h5>
                    <p class="mb-4"><b>MADDE 2</b> – (1) Bu Tebliğ, 6698 sayılı Kişisel Verilerin Korunması Kanununun 22
                        nci maddesinin birinci fıkrasının (e) ve (g) bentlerine dayanılarak hazırlanmıştır.</p>

                    <h5 class="mt-4 mb-3">Tanımlar</h5>
                    <p class="mb-4"><b>MADDE 3</b> – (1) Bu Tebliğde geçen;</p>

                    <ul class="list-unstyled mb-5">
                        <li class="mb-2"><b>a.</b> Alıcı grubu: Veri sorumlusu tarafından kişisel verilerin aktarıldığı
                            gerçek veya tüzel kişi kategorisini,</li>
                        <li class="mb-2"><b>b.</b> İlgili kişi: Kişisel verisi işlenen gerçek kişiyi,</li>
                        <li class="mb-2"><b>c.</b> Kanun: 24/3/2016 tarihli ve 6698 sayılı Kişisel Verilerin Korunması
                            Kanununu,</li>
                        <li class="mb-2"><b>ç.</b> Kurul: Kişisel Verileri Koruma Kurulunu,</li>
                        <li class="mb-2"><b>d.</b> Kurum: Kişisel Verileri Koruma Kurumunu,</li>
                        <li class="mb-2"><b>e.</b> Sicil: Başkanlık tarafından tutulan Veri Sorumluları Sicilini,</li>
                        <li class="mb-2"><b>f.</b> Veri kayıt sistemi: Tamamen veya kısmen otomatik olan ya da herhangi
                            bir veri kayıt sisteminin parçası olmak kaydıyla otomatik olmayan yollarla işlenen kişisel
                            verilerin bulunduğu her türlü ortamı,</li>
                        <li class="mb-2"><b>g.</b> Veri sorumlusu: Kişisel verilerin işleme amaçlarını ve vasıtalarını
                            belirleyen, veri kayıt sisteminin kurulmasından ve yönetilmesinden sorumlu olan gerçek veya
                            tüzel kişiyi,</li>
                        <li class="mb-2"><b>ğ.</b> Veri sorumlusu temsilcisi: Türkiye'de yerleşik olmayan veri
                            sorumlularını 30/12/2017 tarihli ve 30286 sayılı Resmî Gazete'de yayınlanan Veri Sorumluları
                            Sicili Hakkında Yönetmeliğin 11 inci maddesinin ikinci fıkrasında belirtilen konularda asgari
                            temsile yetkili Türkiye'de yerleşik tüzel kişi ya da Türkiye Cumhuriyeti vatandaşı gerçek kişiyi
                            ifade eder.</li>
                    </ul>

                    <p class="mb-5">(2) Bu Tebliğde yer almayan tanımlar için Kanundaki tanımlar geçerli olacaktır.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
