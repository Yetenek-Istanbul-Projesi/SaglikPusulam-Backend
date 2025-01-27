@extends('layouts.master')

@section('title', 'Kullanım Şartları')
@section('body-attr', 'class="page-body"')
@section('main-attr', 'class="start page-content"')

@section('content')
    <nav aria-label="breadcrumb" style="padding:2rem;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('index') }}" class="text-decoration-none">Ana Sayfa</a></li>
            <li class="breadcrumb-item"><a href="{{ url('pages/terms-of-use') }}" class="text-primary">Kullanım Şartları</a>
            </li>
        </ol>
    </nav>
    <div class="container text-center my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-start">
                <h2 class="mb-4">Kullanım Şartları</h2>
                <p class="mb-4">Kullanım Koşulları Son güncellenme:
                    <br>29/12/2024
                </p>

                <div class="text-start">
                    <p>Sevgili ziyaretçimiz, lütfen <a href="https://saglikpusulam.com"
                            target="_blank">saglikpusulam.com</a> web sitemizi ziyaret etmeden önce işbu kullanım koşulları
                        sözleşmesini dikkatlice okuyunuz. Siteye erişiminiz tamamen bu sözleşmeyi kabulünüze ve bu sözleşme
                        ile belirlenen şartlara uymanıza bağlıdır. Şayet bu sözleşmede yazan herhangi bir koşulu kabul
                        etmiyorsanız, lütfen siteye erişiminizi sonlandırınız. Siteye erişiminizi sürdürdüğünüz takdirde,
                        koşulsuz ve kısıtlamasız olarak, işbu sözleşme metninin tamamını kabul ettiğinizin, tarafımızca
                        varsayılacağını lütfen unutmayınız.</p>

                    <p><a href="https://saglikpusulam.com" target="_blank">saglikpusulam.com</a> web sitesi Şirket Adı
                        tarafından yönetilmekte olup, bundan sonra SİTE olarak anılacaktır. İşbu siteye ilişkin Kullanım
                        Koşulları, yayınlanmakla yürürlüğe girer. Değişiklik yapma hakkı, tek taraflı olarak SİTE'ye aittir
                        ve SİTE üzerinden güncel olarak paylaşılacak olan bu değişiklikleri, tüm kullanıcılarımız baştan
                        kabul etmiş sayılır.</p>

                    <h5 class="mt-4 mb-3">Gizlilik</h5>
                    <p>Gizlilik, ayrı bir sayfada, kişisel verilerinizin tarafımızca işlenmesinin esaslarını düzenlemek
                        üzere mevcuttur. SİTE'yi kullandığınız takdirde, bu verilerin işlenmesinin gizlilik politikasına
                        uygun olarak gerçekleştiğini kabul edersiniz.</p>

                    <h5 class="mt-4 mb-3">Hizmet Kapsamı</h5>
                    <p>Şirket Adı olarak, sunacağımız hizmetlerin kapsamını ve niteliğini, yasalar çerçevesinde belirlemekte
                        tamamen serbest olup; hizmetlere ilişkin yapacağımız değişiklikler, SİTE'de yayınlanmakla yürürlüğe
                        girmiş sayılacaktır.</p>

                    <h5 class="mt-4 mb-3">Genel Hükümler</h5>
                    <p class="mb-5">Kullanıcıların tamamı, SİTE'yi yalnızca hukuka uygun ve şahsi amaçlarla
                        kullanacaklarını ve üçüncü kişinin haklarına tecavüz teşkil edecek nitelikteki herhangi bir
                        faaliyette bulunmayacağını taahhüt eder. SİTE dâhilinde yaptıkları işlem ve eylemlerindeki, hukuki
                        ve cezai sorumlulukları kendilerine aittir. İşbu iş ve eylemler sebebiyle, üçüncü kişilerin
                        uğradıkları veya uğrayabilecekleri zararlardan dolayı SİTE'nin doğrudan ve/veya dolaylı hiçbir
                        sorumluluğu yoktur. SİTE'de mevcut bilgilerin doğruluk ve güncelliğini sağlamak için elimizden
                        geleni yapmaktayız. Lakin gösterdiğimiz çabaya rağmen, bu bilgiler, fiili değişikliklerin gerisinde
                        kalabilir, birtakım farklılıklar olabilir. Bu sebeple, site içerisinde yer alan bilgilerin doğruluğu
                        ve güncelliği ile ilgili tarafımızca, açık veya zımni, herhangi bir garanti verilmemekte, hiçbir
                        taahhütte bulunulmamaktadır. SİTE'de üçüncü şahıslar tarafından işletilen ve içerikleri tarafımızca
                        bilinmeyen diğer web sitelerine, uygulamalara ve platformlara köprüler (hyperlink) bulunabilir.
                        SİTE, işlevsellik yalnızca bu sitelere ulaşımı sağlamakta olup, içerikleri ile ilgili hiçbir
                        sorumluluk kabul etmemekteyiz. SİTE'yi virüslerden temizlenmiş tutmak konusunda elimizden geleni
                        yapsak da, virüslerin tamamen bulunmadığı garantisini vermemekteyiz. Bu nedenle veri indirirken,
                        virüslere karşı gerekli önlemi almak, kullanıcıların sorumluluğundadır. Virüs vb. kötü amaçlı
                        programlar, kodlar veya materyallerin sebep olabileceği zararlardan dolayı sorumluluk kabul
                        etmemekteyiz. SİTE'de sunulan hizmetlerde, kusur veya hata olmayacağına ya da kesintisiz hizmet
                        verileceğine dair garanti vermemekteyiz.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
