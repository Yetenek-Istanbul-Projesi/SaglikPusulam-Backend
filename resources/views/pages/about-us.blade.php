@extends('layouts.master')

@section('title', 'Hakkımızda')
@section('body-attr', 'class="page-body"')
@section('main-attr', 'id="about-us"')

@section('content')
    <div class="banner">
        <img src="{{ asset('assets/img/hakkımızda_banner.jpg') }}" style="width: 100%;">
    </div>

    <nav aria-label="breadcrumb" style="padding:2rem; padding-bottom: 0px !important;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('index') }}" class="text-decoration-none">Ana Sayfa</a></li>
            <li class="breadcrumb-item"><a href="{{ url('pages/about-us') }}" class="text-primary">Hakkımızda</a></li>
        </ol>
    </nav>
    <div class="container" style="margin-bottom:10px; padding: 80px;">
        <h1 style="color: #3465FD; margin-bottom: 30px;">Hakkımızda</h1>
        <p style="color: #3465FD; font-size: 25px;">Sağlık Pusulam Nedir?</p>
        <p>
            Kullanıcıların ihtiyaçlarına uygun sağlık hizmetlerini kolayca ulaşabilmelerini sağlamak amacıyla
            geliştirilmiştir. Sağlık Pusulam Sistemi, kullanıcılara en iyi sağlık hizmetlerini il, ilçe ve uzmanlık alanına
            göre filtreleme yaparak listeleme ve karşılaştırma imkânı sunar. Kullanıcılar, bu platform aracılığıyla
            hizmetlerle ilgili kullanıcıların verdiği puanları, yaptığı yorumları ve iletişim bilgilerini görüntüleyebilir
            ve karşılaştırarak tercihlerini ona göre yapabilirler.
        </p>
        <p style="color: #3465FD; font-size: 25px;">Misyonumuz</p>
        <p>
            Sağlık Pusulam olarak misyonumuz, bireylerin sağlık hizmetlerine erişimini kolaylaştırmak ve doğru sağlık hizmet
            sağlayıcılarına ulaşmalarını sağlamaktır. Kullanıcılarımıza il, ilçe ve uzmanlık alanlarına göre filtreleme
            yapabilecekleri, karşılaştırma imkanı sunan ve şeffaf bir platform sunmayı hedefliyoruz. Diğer kullanıcıların
            deneyimlerinden, değerlendirmelerinden ve yorumlarından faydalanarak en doğru sağlık hizmeti seçimini
            yapabilmeleri için rehberlik etmeyi amaçlıyoruz. Kullanıcı dostu arayüzümüz ve detaylı bilgi sistemimizle,
            herkesin kolayca kullanabileceği, güvenilir bir sağlık hizmeti rehberi olmayı misyon ediniyoruz.
        </p>
        <p style="margin-top: 5px; color: #3465FD; font-size: 25px;">Vizyonumuz</p>
        <p>
            Sağlık Pusulam olarak vizyonumuz, Türkiye'nin en kapsamlı ve güvenilir sağlık hizmeti platformu olmaktır.
            Kullanıcılarımıza sunduğumuz filtreleme, karşılaştırma ve değerlendirme sistemimizi sürekli geliştirerek, sağlık
            hizmetlerine erişimi daha da kolaylaştırmayı hedefliyoruz. Platformumuzu, yapay zeka ve teknolojik yeniliklerle
            destekleyerek, kişiselleştirilmiş sağlık hizmeti önerileri sunabilen, kullanıcı deneyimini sürekli iyileştiren
            bir sistem haline getirmeyi amaçlıyoruz. Tüm Türkiye'de yaygın kullanılan, sağlık hizmeti arayanlar için ilk
            başvuru noktası olan, güvenilir ve öncü bir platform olmak için çalışıyoruz.
        </p>
        <p style="margin-top: 5px; color: #3465FD; font-size: 25px;">Amaçlarımız</p>
        <p>
            Sağlık Pusulam olarak temel amacımız, kullanıcılara sağlık hizmetlerine erişimde rehberlik etmek ve doğru sağlık
            hizmeti seçiminde yardımcı olmaktır. Bu kapsamda hedeflerimiz:
        <ul>
            <li>Kullanıcıların ihtiyaç duydukları sağlık hizmetlerine hızlı ve kolay erişimini sağlamak</li>
            <li>Sağlık hizmetleri hakkında şeffaf ve güvenilir bilgi sunmak</li>
            <li>Kullanıcı deneyimlerini paylaşarak topluluk odaklı bir platform oluşturmak</li>
            <li>Sağlık hizmet sağlayıcıları arasında sağlıklı rekabet ortamı yaratmak</li>
            <li>Sağlık hizmetlerinin kalitesinin artmasına katkıda bulunmak</li>
            <li>Kullanıcı dostu ve erişilebilir bir platform sunmak</li>
            <li>Sürekli gelişen teknoloji ile platformumuzu güncel tutmak</li>
        </ul>
        </p>
    </div>

    <div class="section2">
        <p>Soru ve sorunlarınız için <a href="mailto:saglikpusulam@gov.tr">saglikpusulam@gov.tr</a> adresimizi kullanarak
            bize ulaşabilirsiniz.</p>
    </div>
@endsection
