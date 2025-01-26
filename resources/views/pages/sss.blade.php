@extends('layouts.master')

@section('title', 'Sıkça Sorulan Sorular')
@section('main-attr', 'class="start page-content"')

@section('content')
    <nav aria-label="breadcrumb" style="padding:2rem;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('index') }}" class="text-decoration-none">Ana Sayfa</a></li>
            <li class="breadcrumb-item"><a href="{{ url('pages/sss') }}" class="text-primary">Sıkça Sorulan Sorular</a></li>
        </ol>
    </nav>
    <section class="faq-section">
        <h2 style="font-size: 30px; text-align: center; margin: 10px 0px 10px 0px;">Sıkça Sorulan Sorular</h2>

        <!-- Soru 1 -->
        <div class="faq-item">
            <button class="faq-question">
                <span style="color: #FFFF;">Yeni üye kaydımı nasıl yapabilirim?</span>
            </button>
            <div class="faq-answer">
                <p>SağlıkPusulam web sitesi (https://www.saglikpusulam.gov.tr) adresinden “Randevu Al“ butonuna tıkladıktan
                    sonra gelen ekrandan T.C. kimlik numaranız ve parolanız ile giriş yaptıktan sonra ana menüde bulunan
                    "Randevu Bilgileri" menünün altındaki “Randevu Geçmişi” kısmından almış olduğunuz tüm randevuları
                    görüntüleyebilirsiniz. Sağlık Mobil uygulamaya giriş yaptıktan sonra açılan ekranda, sayfanın alt
                    kısmında bulunan “Randevularım” kısmından aldığınız tüm randevuları görebilirsiniz. ALO 182 Çağrı
                    Merkezimizi arayarak da bilgi güvenliği kapsamında sorulan sorulara doğru cevap vermeniz halinde son 90
                    gün içindeki geçmiş randevularınız ve ileriye dönük tüm randevularınız hakkında bilgi alabilirsiniz.</p>
            </div>
        </div>

        <!-- Soru 2 -->
        <div class="faq-item">
            <button class="faq-question">
                <span style="color: #FFFF;">Hesap bilgilerimi nasıl değiştirebilirim?</span>
            </button>
            <div class="faq-answer">
                <p>https://www.saglikpusulam.gov.tr adresinden “Randevu Al“ butonuna tıkladıktan sonra gelen ekrandan T.C.
                    kimlik numaranız ve parolanız ile giriş yaparak ana menüde bulunan "Hesap Bilgileri" menüsünde yer alan
                    sekmelerden ilgili değişiklikleri gerçekleştirebilirsiniz. MHRS Mobil uygulamasından da “Menü” butonuna
                    basarak “Profil” sekmesinden istediğiniz değişiklikleri yapabilirsiniz.</p>
            </div>
        </div>

        <!-- Soru 3 -->
        <div class="faq-item">
            <button class="faq-question">
                <span style="color: #FFFF;">Randevumu nasıl görüntüleyebilirim?</span>
            </button>
            <div class="faq-answer">
                <p>MHRS web sitesi (https://www.mhrs.gov.tr) adresinden “Randevu Al“ butonuna tıkladıktan sonra gelen
                    ekrandan T.C. kimlik numaranız ve parolanız ile giriş yaptıktan sonra ana menüde bulunan "Randevu
                    Bilgileri" menünün altındaki “Randevu Geçmişi” kısmından almış olduğunuz tüm randevuları
                    görüntüleyebilirsiniz. MHRS Mobil uygulamaya giriş yaptıktan sonra açılan ekranda, sayfanın alt kısmında
                    bulunan “Randevularım” kısmından aldığınız tüm randevuları görebilirsiniz. ALO 182 Çağrı Merkezimizi
                    arayarak da bilgi güvenliği kapsamında sorulan sorulara doğru cevap vermeniz halinde son 90 gün içindeki
                    geçmiş randevularınız ve ileriye dönük tüm randevularınız hakkında bilgi alabilirsiniz.</p>
            </div>
        </div>

        <!-- Soru 4 -->
        <div class="faq-item">
            <button class="faq-question">
                <span style="color: #FFFF;">İptal ettiğim randevuyu nasıl geri alabilirim?</span>
            </button>
            <div class="faq-answer">
                <p>İptal edilen randevularda, olası hatalı iptal işlemine karşı 5 dakika boyunca aynı kişi için geri alma
                    imkânı bulunmaktadır. "Geri Al" butonuna basarak iptal ettiğiniz randevuyu tekrar alabilirsiniz.</p>
            </div>
        </div>

        <!-- Soru 5 -->
        <div class="faq-item">
            <button class="faq-question">
                <span style="color: #FFFF;">Yeni üye kaydımı nasıl yapabilirim?</span>
            </button>
            <div class="faq-answer">
                <p>https://www.saglikpusulam.gov.tr adresinden “Randevu Al“ butonuna tıkladıktan sonra gelen ekranda veya
                    saglikpusulam mobil uygulamasını indirerek "Üye Ol" butonuna tıklayıp bilgilerinizi girerek sizin
                    belirleyeceğiniz bir parola ile üyelik oluşturabilirsiniz. Girmiş olduğunuz bilgilerin Nüfus
                    Müdürlüğünde bulunan bilgileriniz ile eşleşmesi gerekmektedir. Aksi takdirde üyelik işleminizi
                    gerçekleştiremezsiniz. Ayrıca “e-Devlet ile Giriş” butonu kullanılarak ayrı bir parola gerekmeksizin web
                    ve mobil uygulama üzerinden sisteme giriş yaparak randevu işlemlerinizi gerçekleştirebilirsiniz.</p>
            </div>
        </div>

        <!-- Soru 6 -->
        <div class="faq-item">
            <button class="faq-question">
                <span style="color: #FFFF;">MHRS üyeliğimi nasıl iptal edebilirim?</span>
            </button>
            <div class="faq-answer">
                <p>https://www.saglikpusulam.gov.tr adresinden “Randevu Al“ butonuna tıkladıktan sonra gelen ekranda veya
                    saglikpusulam mobil uygulamasını indirerek "Üye Ol" butonuna tıkladıktan sonra bilgilerinizi girerek
                    sizin belirleyeceğiniz bir parola ile üyelik oluşturabilirsiniz. Girmiş olduğunuz bilgilerin Nüfus
                    Müdürlüğünde bulunan bilgileriniz ile eşleşmesi gerekmektedir. Aksi takdirde üyelik işleminizi
                    gerçekleştiremezsiniz. Ayrıca “e-Devlet ile Giriş” butonu kullanılarak ayrı bir parola gerekmeksizin web
                    ve mobil uygulama üzerinden sisteme giriş yaparak randevu işlemlerinizi gerçekleştirebilirsiniz.</p>
            </div>
        </div>

        <!-- Soru 7 -->
        <div class="faq-item">
            <button class="faq-question">
                <span style="color: #FFFF;">Aile fertlerim için nasıl randevu alabilirim?</span>
            </button>
            <div class="faq-answer">
                <p>Ebeveynler karşılıklı onay verdikten sonra saglikpusulam Web ve mobil uygulamasında ''Yetkili
                    Olduklarım'' sekmesinden 18 yaş altı çocuklarına randevu alabilirler. Diğer aile bireyleri içinse bilgi
                    güvenliği gereği T.C. kimlik numaraları ve parola ile ayrı ayrı giriş yapılması gerekmektedir. Üyelik
                    kaydı oluşturduğunuz aile fertleriniz için web (https://www.saglikpusulam.gov.tr), MHRS Mobil
                    uygulamasından giriş yaparak veya üyelik kaydı oluşturmadan T.C. Kimlik numarası ile ALO 182 Çağrı
                    Merkezimizi arayarak randevu alabilirsiniz.</p>
            </div>
        </div>

        <!-- Daha fazla soru ve cevap ekleyebilirsiniz -->
    </section>
@endsection
