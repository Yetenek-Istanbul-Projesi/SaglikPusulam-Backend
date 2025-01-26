<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // URL dostu isim
            $table->string('title'); // Başlık
            $table->text('content'); // İçerik
            $table->string('card_title'); // Kart başlığı
            $table->string('card_image'); // Kart resmi
            $table->text('card_summary'); // Kart özeti
            $table->timestamps(); // Oluşturulma ve güncellenme tarihleri
        });

        DB::table('posts')->insert([
            [
                'slug' => 'eklem-iltihabına-iyi-gelen-gidalar',
                'title' => 'Eklem İltihabına İyi Gelen Gıdalar',
                'content' => <<<'EOD'
                    <img src="/SaglikPusulam/assets/img/Artrite-Eklem-Iltihabi-Iyi-Gelen-5-Gida.jpg" alt=""
                  class="img-fluid mb-4 blog_img_head">
                <p class="col-lg-11 col-md-8 mb-7">
                  Eklem İltihabına İyi Gelen Gıdalar
                  Beslenme alışkanlıklarımız yalnızca kilomuzu değil eklem ağrıları dahil sağlığımızla ilgili birçok durumu
                  da etkileyebilir. Yapılan araştırmalar, bazı gıdaların eklem ağrısını hafifletmede faydalı olabileceğini
                  ve artritin (eklem iltihabı) ilerlemesini yavaşlatabileceğini gösteriyor. Beslenmenize doğru gıdaları
                  ekleyerek hem kilonuzu hem de eklem sağlığınızı koruyabilirsiniz.
                  İçindekiler:
                  <br>
                </p>
                <p>
                <h4>Eklem Sağlığı İçin Beslenmenin Önemi</h4>
                <br>
                Farkında olmasak da beslenme alışkanlıklarımız ve tükettiğimiz gıdalar kemik,
                kas ve eklem sağlığımız için önemli rol oynar.
                Yapılan araştırmalar, romatoid artritli hastaların yaklaşık dörtte birinde
                beslenme şeklinin artrit belirtileri üzerinde etkili olduğunu göstermiştir.

                Eklem iltihabı olarak bilinen artrit en sık görülen eklem sorunlarından biridir.
                Artritin birçok türü bulunmakla birlikte osteoartrit (kireçlenme) ve romatoid artrit en yaygın türleridir.
                Eklem kireçlenmesi olarak bildiğimiz osteoartrit;
                eklemde koruyucu görev yapan kıkırdağın aşınma ve yıpranması sonucu oluşur.
                Romatoid artrit ise vücudun bağışıklık sisteminin kendi dokularını yabancı
                sanarak saldırması sonucu meydana gelen otoimmün bir hastalıktır.
                Eklemlerde ağrı, şişlik ve sertlik, zamanla hareketlerde zorlanma gibi
                yakınmalar artrit belirtileri arasındadır.

                Doğru beslenme ile hem kilonuzu hem eklem sağlığınızı koruyabilir,
                artrit ağrılarının hafiflemesine yardımcı olabilirsiniz. Çalışmalar,
                diyetinizde yaptığınız değişikliklerin eklem sağlığınızı
                korumaya ve artrit (eklem iltihabı) belirtilerini hafifletmeye
                yardımcı olabileceğini göstermektedir.
                İşte, beslenme alışkanlığınıza ekleyebileceğiniz artrite iyi gelen 2 gıda:
                <br>
                </p>


                <br>
                <p>
                <h4>Sarımsak ve Soğan</h4>
                <br>
                Aynı bitki ailesinden olan sarımsak ve soğanın bağışıklık sistemini güçlendirdiği,
                kalp hastalıkları, soğuk algınlığı, hatta kanser gibi hastalıklara karşı koruyucu özellik gösterebildiği
                bilinir.
                Sarımsak ve soğanın faydalarından biri de eklem sağlığı üzerinedir. Araştırmalar,
                sarımsak ve soğan gibi allium ailesinden yiyecekleri tüketenlerin kireçlenme ve eklem
                ağrısı gibi durumları daha az yaşadığını işaret etmektedir. Bir araştırmada, daha fazla sarımsak,
                pırasa ve soğan tüketenlerin kalça kireçlenmesi geliştirme olasılığının daha düşük olduğu belirlenmiştir.

                </p>

                <img src="/SaglikPusulam/assets/img/sarimsaklar.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                <p>
                  Sarımsağın koruyucu etkisinin, içerdiği dialil disülfid denilen ve iltihabı önlemeye
                  yardımcı olan bileşik sayesinde olduğu düşünülmektedir.
                  Soğan ve sarımsağı diyetinize eklemek için sos olarak kullanabilir
                  veya çiğ olarak tüketilebilirsiniz.
                </p>

                <h4>Yeşil Yapraklı Sebzeler</h4>
                <br>
                <p>
                  Ispanak, lahana, brokoli gibi yeşil yapraklı sebzeler sağlığa yararlı birçok besin öğesi içerir.
                  Bu sebzelerde bulunan bazı doğal bileşenler artritin neden olduğu iltihaplanmayı azaltmaya yardımcı
                  olabilir.


                  Yeşil yapraklı sebzeler, kıkırdak sağlığı için yararlı olduğu düşünülen K vitamini açısından zengindir.
                  Yeterli miktarda K vitamini almayan yetişkinlerin eklem kireçlenmesine daha yatkın olduğu bilinmektedir.


                  Yapılan bir araştırmada, ıspanakta bulunan kaempferol bileşeninin romatoid artrit ile
                  ilişkili inflamatuar (iltihaba neden olan) etkiyi azaltabileceği gösterilmiştir (4).
                  Benzer şekilde brokoli de inflamasyonun azalmasına ve eklem iltihabının neden olduğu ağrıları hafifletmeye
                  yardımcı olabilir.
                </p>

                <img src="/SaglikPusulam/assets/img/depositphotos_233369934-stock-photo-top-view-fresh-green-vegetables.jpg"
                  alt="" id="blog_img">

                <p>
                  <br>
                  Eklem sağlığınızı korumak ve artrit belirtilerinin azalmasına yardımcı olmak için bu sebzeleri diyetinize
                  eklemeniz önemlidir.
                  Ancak, bu yeşillikler içindeki K vitamini, kan sulandırıcı ilaçların etkisini azaltabilir.
                  Bu nedenle, özellikle herhangi bir ilaç kullanıyorsanız beslenmenizde dikkat etmeniz gereken konular için
                  doktorunuza danışmayı ihmal etmeyin.
                </p>
                EOD
                ,
                'card_title' => 'Eklem İltihabı İyi Gelen <br>Gıdalar',
                'card_image' => 'Artrite-Eklem-Iltihabi-Iyi-Gelen-5-Gida.jpg',
                'card_summary' => 'Beslenme alışkanlıklarımız yalnızca kilomuzu değil eklem
                ağrıları dahil sağlığımızla ilgili birçok durumu da etkileyebilir. Yapılan araştırmalar, bazı gıdaların
                eklem ağrısını hafifletmede faydalı olabileceğini ve artritin (eklem iltihabı) ilerlemesini
                yavaşlatabileceğini gösteriyor.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'akciğer-sagliginizi-korumak-icin-yapmaniz-gerekenler',
                'title' => 'Akciğer Sağlığınızı Korumak İçin Yapmanız Gerekenler',
                'content' => <<<'EOD'
                     <img src="/SaglikPusulam/assets/img/2024081514475131492.jpg" alt="" class="img-fluid mb-4 blog_img_head">
                <br>
                <p>
                  Akciğer sağlığı, genel sağlığımızın önemli bir parçasıdır ve yaşam kalitemizi doğrudan etkiler. Her
                  yıl 1 Ağustos'ta kutlanan Dünya Akciğer Kanseri Günü, akciğer kanserine dikkat çekmek ve
                  farkındalık oluşturmak amacıyla düzenlenir. Bu özel gün vesilesiyle akciğer sağlığımızı korumanın
                  yollarını ve sigorta ürünlerinin bu süreçteki rolünü inceleyelim.
                  <br>
                  <br>
                <h4>1. Sigarayı Bırakın</h4>
                <br>
                Sigara içmek, akciğer sağlığına en büyük zararı veren alışkanlıklardan biridir. Sigara dumanı,
                akciğerlerde ciddi hasarlara yol açar ve akciğer kanseri riskini önemli ölçüde artırır. Sigara içenlerin
                sigarayı bırakmaları, akciğer sağlığını korumak için atılacak en önemli adımdır. Sigara içmeyi
                bırakanlar, birkaç yıl içinde akciğer fonksiyonlarının iyileştiğini ve akciğer kanseri riskinin azaldığını
                görebilirler.
                <br>
                <br>
                <h4>2. Temiz Hava Soluyun</h4>
                <br>
                Akciğer sağlığını korumak için temiz hava solumak çok önemlidir. Hava kirliliği, akciğerlerde ;
                iltihaplanmaya ve kronik solunum yolu hastalıklarına yol açabilir. Mümkün olduğunca temiz hava
                olan yerlerde vakit geçirmek ve ev içinde hava kalitesini artırmak için hava temizleyiciler kullanmak,
                akciğer sağlığını korumak adına alınabilecek önlemler arasındadır. Ayrıca, açık hava egzersizlerini
                yoğun trafik olan bölgelerden uzak yerlerde yapmak da faydalıdır.
                <br>
                <br>
                <h4>4. Düzenli Egzersiz Yapın</h4>
                <br>
                Düzenli egzersiz, akciğer kapasitesini artırır ve solunum kaslarını güçlendirir. Haftada en az 150 İ
                dakika orta düzeyde egzersiz yapmak, akciğer sağlığını korumak için önerilir. Yürüyüş, koşu, yüzme
                ve bisiklet gibi kardiyo egzersizleri, akciğerlerin daha verimli çalışmasına yardımcı olur. Egzersiz
                sırasında derin nefes alıp vermek, akciğerlerin tam kapasiteyle çalışmasını sağlar ve bu da akciğer
                fonksiyonlarını iyileştirir.
                <br>
                <br>
                <h4>4. Sağlıklı Beslenin</h4>
                <br>
                Beslenme alışkanlıkları, akciğer sağlığını doğrudan etkiler. Antioksidanlar açısından zengin gidalar
                tüketmek, akciğerlerin serbest radikallerin zararlarından korunmasına yardımcı olur. Meyve, sebze,
                tam tahıllar ve sağlıklı yağlar, akciğer sağlığını destekleyen besinler arasında yer alır. Özellikle C ve
                E vitamini, beta-karoten ve omega-3 yağ asitleri, akciğer dokusunun sağlıklı kalmasına yardımcı
                olan önemli bileşenlerdir.
                <br>
                </p>

                <img src="/SaglikPusulam/assets/img/Kart2_2.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                <br>
                <h4>5. Sağlık Sigortası ile Güvence Altına Alın</h4>
                <br>
                Akciğer sağlığınızı korumak için alınacak önlemler kadar, beklenmedik sağlık sorunlarına karşı hazırlıklı
                olmak da önemlidir.
                Sağlık sigortası ürünleri, akciğer sağlığınız için gerekli olan tıbbi bakımı ve tedaviyi karşılamada büyük
                bir avantaj sağlar.
                Sigorta yaptırmak, özellikle ciddi sağlık sorunları yaşandığında finansal güvence sunar. Örneğin, akciğer
                kanseri gibi ciddi bir hastalıkla karşılaşıldığında,
                tedavi masraflarının büyük bir kısmı sağlık sigortası tarafından karşılanır. Demir Sağlık gibi güvenilir
                sigorta şirketlerinden sağlık sigortası yaptırarak,
                akciğer sağlığınızı ve genel sağlığınızı güvence altına alabilirsiniz.
                EOD
                ,
                'card_title' => 'Akciğer Sağlığınızı Nasıl Koruyabilirsiniz?',
                'card_image' => '2024081514475131492.jpg',
                'card_summary' => <<<'EOD'
                'Akciğer sağlığı, genel sağlığımızın önemli bir parçasıdır
                ve yaşam kalitemizi doğrudan etkiler. Her yıl 1 Ağustos'ta kutlanan Dünya Akciğer Kanseri Günü, akciğer
                kanserine dikkat çekmek ve farkındalık oluşturmak amacıyla düzenlenir. Bu özel gün vesilesiyle akciğer
                sağlığımızı korumanın yollarını ve sigorta ürünlerinin bu süreçteki rolünü inceleyelim.
                EOD
                ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'bobrek-sagliginiz-korumak-icin-yapmaniz-gerekenler',
                'title' => 'Böbrek Sağlığınızı Korumak İçin Yapmanız Gerekenler',
                'content' => <<<'EOD'
                <img src="/SaglikPusulam/assets/img/Kart3_1.jpg" alt="" class="img-fluid mb-4 blog_img_head">
                <br>
                <p>
                  Böbrek sağlığı, genel sağlığımızın önemli bir parçasıdır ve böbreklerin düzgün çalışması, vücudumuzun
                  toksinlerden arınması için hayati öneme sahiptir.
                  Böbreklerin sağlığını korumak, yaşam kalitemizi arttırmak ve böbrek hastalıklarından korunmak için
                  önemlidir. Bu yazıda,
                  böbrek sağlığınızı korumak için yapmanız gerekenleri ve sağlık sigortası ürünlerinin bu süreçteki rolünü
                  ele alacağız.
                  Ayrıca, 8 Ağustos Dünya Böbrek Sağlığı Günü'nün önemine değineceğiz.
                  <br>
                  <br>
                  <h4>1. Yeterli Miktarda Su İçin</h4>
                  <br>
                  Böbrek sağlığı için su neden önemlidir? Su, böbreklerin en iyi şekilde çalışması için temel bir ihtiyaçtır.
                  Yeterli miktarda su içmek, böbreklerin toksinleri ve atık maddeleri süzmesine yardımcı olur.
                  Günlük olarak en az 2-3 litre su içmek, böbrek sağlığını korumak için önerilen miktardır.
                  Yeterli su tüketimi, idrar yolu enfeksiyonlarını önler ve böbrek taşlarının oluşum riskini azaltır.
                  Su içmek, vücudun nem dengesini korur ve böbreklerin düzgün çalışmasını sağlar.
                  <br>
                  <br>
                  <h4>2. Sağlıklı Beslenme Alışkanlıkları Edinin</h4>
                  <br>
                  Böbrek sağlığı için beslenme, büyük bir role sahiptir. Böbrek sağlığını korumak için yapmanız
                  gerekenler arasında dengeli ve sağlıklı bir diyet önemli bir yer tutar.
                  Böbrek sağlığı için faydalı besinler arasında taze meyve ve sebzeler,
                  tam tahıllar ve düşük yağlı protein kaynakları bulunur.
                  Özellikle yeşil yapraklı sebzeler, böbreklerin fonksiyonlarını destekleyen
                  önemli vitamin ve mineraller içerir. Bunun yanı sıra, tuz ve işlenmiş gıdalardan
                  kaçınmak, böbrek sağlığı için dikkat edilmesi gereken önemli bir noktadır.
                  Böbrek sağlığı için en zararlı besinler arasında yüksek sodyum içeren yiyecekler,
                  aşırı şeker ve doymuş yağlar bulunur.
                </p>
                <br>
                <br>
                <img src="/SaglikPusulam/assets/img/Kart3_2.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                <br>
                <p>
                  <h4>3. Düzenli Egzersiz Yapın</h4>
                  <br>
                  Düzenli fiziksel aktivite, böbrek sağlığını korumak için yapılması gerekenler arasında yer alır.
                  Egzersiz, kan dolaşımını artırır ve böbreklerin daha verimli çalışmasını sağlar.
                  Haftada en az 150 dakika orta düzeyde egzersiz yapmak,
                  böbrek sağlığı için önerilir. Yürüyüş, yüzme, bisiklet sürme gibi aktiviteler,
                  böbrek fonksiyonlarını iyileştirir ve genel sağlığı destekler. Egzersiz ayrıca,
                  ideal vücut ağırlığını korumaya yardımcı olur ve obezite gibi
                  böbrek hastalıklarına yol açabilecek risk faktörlerini azaltır.
                </p>
                <br>
                <br>
                <img src="/SaglikPusulam/assets/img/Kart3_3.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                <br>
                <p>
                  <h4>4. Düzenli Sağlık Kontrolleri Yaptırın</h4>
                  <br>
                  Böbrek sağlığı için ne yapmalıyız sorusunun bir diğer cevabı ise düzenli sağlık kontrolleridir.
                  Böbrek fonksiyonlarını düzenli olarak kontrol ettirmek, erken teşhis ve tedavi
                  açısından önemlidir. Yüksek tansiyon ve diyabet gibi kronik hastalıklar,
                  böbrek sağlığını olumsuz etkileyebilir. Bu nedenle, bu tür hastalıklara sahip
                  bireylerin düzenli olarak doktor kontrollerine gitmeleri ve böbrek
                  fonksiyonlarını izlemeleri gerekmektedir. Erken teşhis, böbrek hastalıklarının
                  ilerlemesini önler ve tedavi sürecini kolaylaştırır.
                  <br>
                  <br>
                  <h4>5. Sağlık Sigortasının Önemi</h4>
                  <br>
                  Böbrek sağlığını korumak için alınacak önlemler kadar, beklenmedik sağlık sorunlarına karşı hazırlıklı olmak
                  da önemlidir.
                  Sağlık sigortası ürünleri, böbrek sağlığı için gerekli olan tıbbi bakımı ve tedaviyi karşılamada büyük bir
                  avantaj sağlar.
                  Sağlık sigortası yaptırmak, özellikle ciddi böbrek hastalıkları yaşandığında finansal güvence sunar.
                  Demir Sağlık gibi güvenilir sigorta şirketlerinden sağlık sigortası yaptırarak,
                  böbrek sağlığınızı ve genel sağlığınızı güvence altına alabilirsiniz.
                  Sağlık sigortası, düzenli sağlık kontrolleri ve olası tedavi masraflarını
                  karşılayarak, beklenmedik durumlar karşısında rahat olmanızı sağlar.
                  <br>
                  <br>
                  <h4>6. 8 Ağustos Dünya Böbrek Sağlığı Günü</h4>
                  <br>
                  8 Ağustos Dünya Böbrek Sağlığı Günü, böbrek sağlığı hakkında farkındalık yaratmak
                  ve böbrek hastalıklarına dikkat çekmek amacıyla kutlanır.
                  Bu özel gün, böbrek sağlığını korumak için alınması gereken önlemler
                  hakkında toplumu bilgilendirmek için çeşitli etkinlikler ve kampanyalarla
                  desteklenir. Dünya Böbrek Sağlığı Günü, böbrek hastalıklarının erken
                  teşhisinin ve tedavisinin önemine dikkat çeker. Bu gün vesilesiyle,
                  sağlıklı yaşam alışkanlıkları benimsemek ve böbrek sağlığını korumak için
                  adımlar atmak teşvik edilir.
                  <br>
                  Tüm bu bilgiler ışığında; böbrek sağlığınızı korumak için yeterli miktarda su içmek,
                  sağlıklı beslenmek, düzenli egzersiz yapmak, düzenli sağlık kontrolleri
                  yaptırmak ve sağlık sigortası yaptırmak gibi adımlar atmanız gerekir.
                  8 Ağustos Dünya Böbrek Sağlığı Günü, böbrek sağlığının önemine dikkat çekmek ve bu konuda farkındalık
                  yaratmak için önemli bir fırsattır.
                  Böbreklerinizi koruyarak, genel sağlığınızı iyileştirebilir ve yaşam
                  kalitenizi artırabilirsiniz. Sağlıklı bir böbrek fonksiyonu için bu
                  önerileri hayatınıza dahil edin ve sağlık sigortası ile geleceğinizi güvence
                  altına alın.
                </p>
                EOD
                ,
                'card_title' => 'Böbrek Sağlığınımızı Nasıl Koruruz?',
                'card_image' => 'nsf-onayli-su-aritma-cihazi-surahi-su-kadin-4.jpg',
                'card_summary' => <<<'EOD'
                Böbrek sağlığı, genel sağlığımızın önemli bir parçasıdır
                ve böbreklerin düzgün çalışması, vücudumuzun toksinlerden arınması için hayati öneme sahiptir.
                Böbreklerin sağlığını korumak, yaşam kalitemizi arttırmak ve böbrek hastalıklarından korunmak için
                önemlidir. Bu yazıda, böbrek sağlığınızı korumak için yapmanız gerekenleri ve sağlık sigortası
                ürünlerinin bu süreçteki rolünü ele alacağız.
                EOD
                ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'boyun-kireclenmesi-tedavisi',
                'title' => 'Boyun Kireçlenmesi: Belirtileri, Nedenleri ve Tedavi Seçenekleri',
                'content' => <<<'EOD'
                <img src="/SaglikPusulam/assets/img/Kart4_1.jpg" alt="" class="img-fluid mb-4 blog_img_head">
                 <br>
                 <p>
                    Tetik parmak hastalığı özellikle orta-ileri yaş bayanlarda sık görülen ve
                    tekrarlayan parmak hareketleri sonrası ağrıya ve hareket kısıtlılığına yol
                    açan bir tendon hastalığıdır. Tetik parmakta parmağı hareket ettiren
                    tendondaki iltihap ve genişleme neticesinde tendonların geçtiği tünellerde
                    takılma meydana gelir ve bunun sonucu olarak parmakları hareket ettirirken
                    takılma hissi, ağrı ve parmakları tamamen açamama yani parmaklarda
                    kilitlenme oluşur. Tetik parmak hastalığının tedavisinde eğer şikayetler
                    hafif düzeydeyse ve parmakta tam takılma yoksa öncelikle ameliyat dışı
                    tedaviler uygulanmaktadır. Ameliyat dışı tedaviler şikayetleri ve hareket
                    kısıtlılığını iyileştirmezse tetik parmak hastalığının kesin tedavisi
                    ameliyat tedavisidir. Tetik parmak hastalığında ameliyat tedavisi lokal
                    anestezi altında yapılabilmekte ve ameliyat sonrası hareketlere hemen
                    başlanabilmektedir. Tetik parmak hastalığında ameliyat tedavisi Ortopedi
                    ve Travmatoloji hekimi tarafından uygulanmaktadır.

                    <br>
                    <br>
                    <h4>Tetik Parmak Hastalığı Nedir?</h4>
                    <br>
                    Tetik parmak, parmağın katlanmış durumda sabit kalması veya
                    takılarak açılması şeklinde bulgu veren parmakta ağrı ve hareket
                    kısıtlılığına sebep olan hastalığın adıdır. Parmak katlanmış
                    pozisyondayken takılır ve açılmaz, bazen de tetiğe benzer bir şekilde
                    aniden açılarak düz pozisyona gelir. Tetik parmak hastalığı parmakta
                    takılmaya ve ağrıya sebep olan bir tendon hastalığıdır.

                    <br>
                    <br>
                    <h4>Tetik Parmak Hastalığı Neden Olur?</h4>
                    <br>
                    Tetik parmak hastalığı parmakların sık kullanıldığı işlerle uğraşan
                    insanlarda veya sürekli tekrarlayan parmak hareketleri yapan insanlarda
                    sık görülmektedir. Ayrıca romatoid artrit veya diyabet hastalarında da
                    sık görülmektedir. Tetik parmak hastalığı kadınlarda sık görülmektedir.

                 </p>
                 <br>
                 <br>
                 <img src="/SaglikPusulam/assets/img/Kart4_2.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                 <br>
                 <p>
                  <h4>Tetik Parmak Hastalığının Belirtileri Nelerdir?</h4>
                  <br>
                  Tetik parmak hastalığının en sık belirtisi hastanın etkilenen parmağında çok
                  net hissettiği takılma hissi ve ağrıdır. Parmakta takılma, takılı kalmış
                  pozisyondayken aniden parmakta açılma ve hastalığın ilerlediği kişilerde
                  parmağın takılı pozisyonda kalması en sık görülen belirtilerdir.
                  Özetle eğer aşağıdaki belirtilere sahipseniz tetik parmak hastalığı
                  açısından Ortopedi ve
                  <br>
                  <br>
                  Travmatoloji uzmanına mutlaka başvurmalısınız;
                  <ul>
                        <li>Parmaklarda hareket kısıtlılığına yol açan takılma hissi</li>
                        <li>Parmakları tamamen açmaya engel olan tam takılma</li>
                        <li>Parmaklarda takılma sonrası aniden açılma</li>
                        <li>Parmaklarda ağrı</li>
                        <li>Parmaklarda hareket kısıtlılığı</li>
                        <li>Parmaklarda ele gelen şişlik ve hassasiyet</li>
                  </ul>
                  <br>
                  <br>
                  <h4>Tetik Parmak Hastalığı İçin Hangi Doktora Gidilir?</h4>
                  <br>
                  Parmakta takılma ve ağrı şikayeti olan hastalar bu durumun tedavisi
                  için Ortopedi ve Travmatoloji Uzmanına veya Fiziksel Tıp ve Rehabilitasyon
                  Uzmanına başvurabilirler. Fiziksel Tıp ve Rehabilitasyon Uzmanı hastayı
                  ameliyat dışı tedavi yöntemleriyle tedavi eder. Eğer ameliyat dışı tedavi
                  yöntemleri başarısız olursa hastayı Ortopedi ve Travmatoloji Uzmanına
                  yönlendirebilir.
                 </p>

                 <br>
                 <br>
                 <img src="/SaglikPusulam/assets/img/Kart4_3.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                 <br>
                 <p>
                  <h4>Tetik Parmak Hastalığı Nasıl Teşhis Edilir?</h4>
                  <br>
                  Tetik parmak hastalığının teşhisi çoğu zaman hastanın şikayetleri,
                  hastalığın öyküsü ve fizik muayene ile yapılmaktadır. Görüntüleme
                  yöntemleri olan röntgen ve MR görüntüleme ayırıcı tanıda
                  istenebilmektedir.
                  <br>
                  Tetik parmak hastalığının teşhisi çoğu zaman hastanın şikayetleri,
                  hastalığın öyküsü ve fizik muayene ile yapılmaktadır. Görüntüleme yöntemleri olan
                  röntgen ve MR görüntüleme ayırıcı tanıda istenebilmektedir.
                  <br>
                  Doktor takılma olan parmağı muayene eder ve önce parmağın pasif ve
                  aktif hareketlerini kontrol eder. Daha sonra takılma olan bölgeye
                  dokunarak burada ağrı olup olmadığını kontrol eder. Çoğunlukla A1
                  pulleyde gözüken tetik parmak hastalığında, doktor A1 pulley üzerine
                  dokunurken takılmayı hissedebilir. Bu muayene bulgusu tetik parmak
                  hastalığının temel muayene bulgusudur.
                  Tetik Parmak Hastalığı Tedavi Seçenekleri Nelerdir?
                  <br>
                  <br>
                  <h4>Tetik Parmak Ameliyatsız Tedavileri</h4>
                  <br>
                  Tetik parmak hastalığında ameliyatsız tedavi çoğu hastanın ilk
                  tercihi olup bu durumda en etkili tedavi yöntemi hastaya tarif
                  edilen egzersizlerin hasta tarafından düzenli olarak yapılması ve
                  hastalığı arttıran tekrarlayıcı aktif hareketlerden kaçınmaktır.
                  Tetik parmak hastalığında ameliyatsız tedavi yöntemleri başarısız
                  olursa ameliyatla tedavi kaçınılmazdır.
                  İstirahat: Etkilenen parmağın istirahat ettirilmesi ve bulguları
                  arttıran hareketlerden kaçınmak uygulanacak ilk basamak tedavi
                  yöntemidir.
                  <br>
                  Tetik Parmak Ateli: Gece yatarken parmağı istirahat pozisyonunda
                  tutan bir parmak ateli uygulaması şikayetleri azaltabilmektedir.


                 </p>
                EOD
                ,
                'card_title' => 'Tetik Parmak Hastalığı ve Tedavi Yöntemleri',
                'card_image' => 'Tetik-Parmak-Hastaligi-ve-Tedavi-Yontemleri-Nelerdir.jpg',
                'card_summary' => <<<'EOD'
                Tetik parmak, parmağın katlanmış durumda sabit kalması
                veya
                takılarak açılması şeklinde bulgu veren parmakta ağrı ve hareket kısıtlılığına sebep olan hastalığın
                adıdır.
                Parmak katlanmış pozisyondayken takılır ve açılmaz, bazen de tetiğe benzer bir şekilde aniden açılarak
                düz
                pozisyona gelir. Tetik parmak hastalığı parmakta takılmaya ve ağrıya sebep olan bir tendon hastalığıdır.
                EOD
                ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'ucuncu-yazi',
                'title' => 'Üçüncü Yazım',
                'content' => <<<'EOD'
                <img src="/SaglikPusulam/assets/img/Kart5_1.webp" alt="" class="img-fluid mb-4 blog_img_head">
                <br>
                <p>
                  Kireçlenme denildiğinde aklınıza ağrıyan diz ve kalçalar geliyor olabilir. Ancak boynunuzda bir sertlik hissediyorsanız veya başınızı çevirdiğinizde ağrınız varsa, bu ağrının da boyun kireçlenmesi kaynaklı olabileceğini biliyor muydunuz?
                  Vücudun geri kalanı gibi, boyundaki diskler ve eklemler de aşınma ve yıpranma nedeniyle hasar görmektedir.
                  Boyun kireçlenmesine bağlı gelişen boyun ağrıları toplumda yaygın olarak görülmektedir. Özellikle 60 yaşın üzerindeki kişilerin yarısından fazlasını etkileyebilmektedir. Boyun kireçlenmesinin ağrı ile beraber en sık görülen bir diğer belirtisi de boyunda sertliktir.
                </p>
                <br>
                <h4>Boyun Kireçlenmesi (Servikal Spondiloz) Nedir?</h4>
                <br>
                <p>
                  Omurganız, üst üste yığılmış omur adı verilen kemiklerden oluşmaktadır. Servikal omurga (boyun) ise kafatasının tabanından başlayan yedi omurdan meydana gelir. Boyun kireçlenmesi, servikal boyun bölgesini oluşturan 7 omurda görülmektedir. Her omur arasında; diskler, faset eklemler, kıkırdaklar ve bağlar bulunmaktadır. Kıkırdak zamanla yıpranır, diskler hacimlerini kaybeder ve kurur, bağlar kalınlaşabilir, kemiklerin kıkırdakla kaplı olmayan bölümlerinde sürtünme ve kemik çıkıntıları oluşabilir.
                  Servikal omurgadaki disklerin ve çevre yapıların özelliğini kaybetmesi sonucu oluşan aşınma ve yıpranmalar ise boyun kireçlenmesine neden olmaktadır. Boyun kireçlenmesi yaygın olarak görülen bir sorun olmakla birlikte yaş ilerledikçe artabilmektedir. Özellikle ileri yaşlarda, 60 yaş ve üzeri bireylerin %85’inden fazlası boyun kireçlenmesinden etkilenmektedir.
                </p>
                <br>
                <img src="/SaglikPusulam/assets/img/Kart5_2.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                <br>
                <p>
                <h4>Boyun Kireçlenmesi Belirtileri Nelerdir?</h4>
                <br>
                  Boyun kireçlenmesi başlangıçta hiçbir belirtiye neden olmayabilir. Ancak belirtiler ortaya çıktığında boyun ağrısı ve boyun sertliği ile kendini göstermektedir. Bu ağrı zaman zaman artar ve azalır.
                  Örneğin kitap okumak, araba kullanmak gibi aktivitelerde uzun süre aynı pozisyonda durmaya bağlı olarak ağrılar artabilmektedir. Ancak bu tür ağrılar, genellikle dinlenme ile azalır.
                  En sık görülen boyun kireçlenmesi belirtileri:
                </p>
                <ul>
                  <li>Baş ağrısı ve baş dönmesi,</li>
                  <li>Boyun ağrısı ve boyunda sertlik,</li>
                  <li>Omuzdan kola doğru yayılan ağrı,</li>
                  <li>Boyundan ses gelmesi,</li>
                  <li>Kas spazmlarıdır.</li>
                </ul>
                <br>
                <p>
                  Peki, Boyun kireçlenmesi ilerlerse ne olur? Kireçlenmenin artması ve omurilik veya sinir köklerinin sıkışması halinde, boyun kireçlenmesi belirtileri daha ciddi nörolojik durumlara yol açmaktadır.
                  Bu belirtiler:
                </p>
                <ul>
                  <li>Kollarda, ellerde, bacaklarda veya ayaklarda; karıncalanma, uyuşma ve güçsüzlük,</li>
                  <li>Denge bozukluğu ve yürüme zorluğu,</li>
                  <li>Mesane veya bağırsak kontrolünün kaybıdır.</li>
                </ul>
                <br>
                <p>
                  Eğer siz de yukarıdaki ciddi boyun kireçlenmesi belirtilerinden herhangi birine sahipseniz, vakit kaybetmeden bir <span style="text-decoration: underline; font-weight: bold;">ortopedi uzmanına</span> başvurunuz.
                </p>
                <br>
                <img src="/SaglikPusulam/assets/img/Kart5_3.jpeg" alt="" class="img-fluid mb-4" id="blog_img">
                <br>
                <p>
                  Boyun kireçlenmesinde yaygın olarak görülen iki tür bulunmaktadır. Bunlar; radikülopati ve miyelopatidir.
                  Radikülopati, sinirin ana omurilikten ayrılan kısmı olan spinal sinir kökü etkilendiğinde meydana gelir. Genellikle, spinal sinir kökü üzerinde baskı, ağrı, halsizlik, uyuşukluk gibi boyun kireçlenmesi belirtilerine neden olmaktadır.
                  Miyelopati, yavaş yavaş ortaya çıkan ve omuriliği etkileyerek ciddi nörolojik sorunlara yol açabilen bir hastalık sürecidir. Boyun bölgesinde miyelopati gelişen kişilerde; ağrı, uyuşukluk, hissizlik, güçsüzlük, yürüyememe, idrarını tutamama gibi belirtiler görülmektedir.
                </p>
                EOD
                ,
                'card_title' => 'Boyun Kireçlenmesi Belirtileri ve Tedavisi',
                'card_image' => 'boyun-kireclenmesi.png',
                'card_summary' => <<<'EOD'
                Boyun kireçlenmesi, servikal boyun bölgesini oluşturan 7
                omurda
                görülmektedir. Her omur arasında; diskler, faset eklemler, kıkırdaklar ve bağlar bulunmaktadır. Kıkırdak
                zamanla yıpranır, diskler hacimlerini kaybeder ve kurur, bağlar kalınlaşabilir, kemiklerin kıkırdakla
                kaplı
                olmayan bölümlerinde sürtünme ve kemik çıkıntıları oluşabilir.
                EOD
                ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'bakteriyofaj-tedavisi-bir-cozum-olabilir-mi',
                'title' => 'Bakteriyofaj Tedavisi Bir Çözüm Olabilir Mi?',
                'content' => <<<'EOD'
                <img src="/SaglikPusulam/assets/img/Kart6_1.jpg" alt="" class="img-fluid mb-4 blog_img_head">
                <p class="col-lg-11 col-md-8 mb-7">
                  “Covid-19, Dünya çapında milyonlarca insanı etkileyerek ve binlerce insanın ölümüne neden olarak küresel
                  bir tehdit oluşturmaya devam etmektedir. Hayatımızı kökünden etkileyen bir pandemiye dönüşen koronavirüs
                  salgını bile, antibiyotiğe dirençli bakterilerin neden olduğu enfeksiyonların tehdidi yanında hala sönük
                  kalmaktadır.” Dünya Sağlık Örgütü verilerine göre 26.08.2020 tarihi itibari ile Dünya genelinde Covid-19 tespit edilen
                  vaka sayısı 24 milyonu ve yeni tip korona virüs nedeni ile hayatını kaybedenlerin sayısı 823 bini buldu.
                  Dünya Sağlık Örgütü antibiyotik direncinden kaynaklı ölümlerin ise Dünya çapında her yıl 700.000’i
                  bulduğunu tahmin etmektedir. Geleceğimize dair korkutucu tahminlerden biri ise; eğer önlem alınmazsa bu
                  yıllık antibiyotik direnci nedeni ile ölüm sayısının 2050’ye kadar 10 milyonu bulacağıdır.
                  <br>
                </p>
                <p>
                <h4>Antibiyotikler | Antibiyotik Direnci Nedir?</h4>
                <br>
                Antibiyotikler, keşiflerinden itibaren sağlığımız için zararlı olan bakterilere karşı mücadelemizde
                insanlığın en etkili silahlarından biri oldu. Şu an için en basit olarak tanımladığımız mikroorganizmaların neden olduğu enfeksiyonlar çok şiddetli
                hastalıklara ve ölümlere neden olabilmekteydi. Enfeksiyonlara neden olan bakteriler vücudumuzdaki bir
                kesikten veya bir su birikintisinden gelerek organizmamız için hayati sorunlara yol açabilmekteydi. İçinde
                bulunduğumuz zamandan baktığımızda, antibiyotiklerin kullanımının bilinmediği dönemler inanılmaz
                gelebilir. Antibiyotiklerin kullanımı, insanlık için bu kadar önemli ve tarihe damgasını vuran bir rol
                üstlenmiş olmasına rağmen ironi tam da buradan, antibiyotiklerin kullanımından doğmaktadır.
                <br>
                </p>
                <img src="/SaglikPusulam/assets/img/Kart6_2.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                <p>
                <br>
                Antibiyotik direnci olarak adlandırılan bu durum; ilaçların belirli bir dozda kullanımı sonucu oluşturduğu
                etkinin, aynı dozda tekrarlayan kullanımlarından sonra azalması veya aynı etkiyi oluşturmak için daha
                yüksek dozda kullanılmalarının gerekliliğidir. Antibiyotik direnci kısaca tarif edersek bakterilerin
                antibiyotik kullanımına karşı direnç kazanması ve antibiyotiklerin bazı bakterilere karşı artık etkin
                olamamasıdır. Antibiyotiklerimize karşı direnç, gün geçtikçe, bakteriler arasında yayılmaya devam etmektedir. Bu durum
                yakın gelecekte bakterilerin daha fazla ölüme neden olacağını ve elimizdeki silahlarımız olan
                antibiyotiklerin enfeksiyona neden olan çoğu bakteriye karşı etkisiz kalacağını göstermektedir.
                Gerekli önlemlerin alınmaması durumunda mevcut antibiyotiklerin çoğu enfeksiyon hastalığının tedavisinde
                etkisini kaybedeceği beklenmektedir.
                </p>
                <h4>Bakteriyofaj Tedavisi, Dirençli Bir Bakteriyel Enfeksiyonu Nasıl Tedavi Edebilir?</h4>
                <p>
                Bakteriyofajlar (Fajlar) hepsi belli bakterilere bağlanır ve bakteriye kendi genlerini (DNA, RNA) enjekte
                eder. Bakteri içinde faj kendi kopyasını üreterek çoğalır ve en sonunda bakteriyi patlatarak ölümüne neden
                olur. Bu sayede yeni bakteriyofajlar oluşur ve diğer bakterileri etkisiz hale getirmeye devam
                eder. Bakteriyofajlar sadece bakteri içinde çoğalabildikleri için bakterilerin tamamı parçalandığında
                çoğalmayı bırakırlar.
                </p>
                <img src="/SaglikPusulam/assets/img/Kart6_3.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                <p>
                Bakteriler zaman içinde antibiyotik kullanımına karşı mutasyonlar geçirerek direnç kazanabilmektedir. Bu
                mutasyonlar “süper bakterilerin” ortaya çıkmasına neden olmakta ve insanları enfeksiyonlara karşı
                savunmasız bırakmaktadır. Bakterilere karşı doğru fajların seçilmesi ve uygulanması ile; antibiyotik dirençli bakterilere karşı
                doğal düşmanları kullanarak etkili sonuçlar alınabilmektedir. Ayrıca fajlar kendiliğinden çoğaldığından
                antibiyotiklerin aksine kimi zaman bir doz uygulanması bile yeterli olabilmektedir.
                </p>
                <h4>Bakteriyofaj Tedavisinin Kullanım Alanları Nelerdir?</h4>
                <br>
                <p>
                Bakteriyofajlar birçok enfeksiyon rahatsızlıklarının tedavisinde kullanılabilmektedir. Bakteriyofaj
                tedavisinin başlıca kullanım alanları:
                Bakteriyofaj tedavisi açık ve uzun süre kapanmayan yaraların tedavisinde uygulanabilmektedir. Hastanın
                yara kaynağı bakteri grubu tespit edilerek etkili faj seçimi ile tedavi uygulaması yapılmaktadır.
                Diyabetik ayak enfeksiyonlarında bakteriyofaj tedavisi uygulanabilmektedir.
                Ortopedik eklem protez cerrahisi sonrası oluşabilecek enfeksiyonlarda bakteriyofaj tedavisine
                başvurulabilmektedir.
                Kemik iltihaplanması (Osteomyelit) için bakteriyofaj tedavisi yapılabilmektedir.
                </p>
                EOD
                ,
                'card_title' => 'Bakteriyofaj Tedavisi Bir Çözüm Olabilir Mi?',
                'card_image' => '774299c17c41ae4f289cb5b7afa03dbc77ad419e.jpg',
                'card_summary' => <<<'EOD'
                Dünya Sağlık Örgütü antibiyotik direncinden kaynaklı
                ölümlerin
                ise Dünya çapında her yıl 700.000’i bulduğunu tahmin etmektedir. Geleceğimize dair korkutucu
                tahminlerden biri
                ise; eğer önlem alınmazsa bu yıllık antibiyotik direnci nedeni ile ölüm sayısının 2050’ye kadar 10
                milyonu
                bulacağıdır.
                EOD
                ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'kapali-ayak-ameliyati-perkutan-yontem-ve-avantajlari',
                'title' => 'Kapalı Ayak Ameliyatı: Perkütan Yöntem ve Avantajları',
                'content' => <<<'EOD'
                <img src="/SaglikPusulam/assets/img/Kart7_1.webp" alt="" class="img-fluid mb-4 blog_img_head">
                <br>
                <p>
                  Ayak ağrıları ve ayak bileği sorunlarına çare arayan hastalar için, cerrahi müdahale adeta bir dönüm noktasıdır. Uzun yıllardır standart tedavi yöntemi olarak kabul edilen geleneksel ayak ameliyatları, iyileşme süreçlerinin uzunluğu, olası komplikasyon riskleri ve ameliyat sonrası sıklıkla yaşanan ayak ağrıları nedeniyle hastaları endişelendirmektedir. Bu tedirginlikler, ayak ağrılarından muzdarip olan birçok kişinin tedaviye başlama konusunda tereddüt etmesine veya bazı durumlarda tedaviden tamamen vazgeçmesine yol açabilir.
                  <br>
                  <br>
                  Ancak, tıptaki büyük yenilikler sayesinde bu endişelendiren durumlar yavaş yavaş değişmekte. Minimal invaziv cerrahi, yani küçük kesilerle yapılan müdahaleler, ayak ve ayak bileği ameliyatlarında önemli farklar yaratmaktadır. Günümüzde, ayak ve ayak bileği ameliyatları, perkütan adı verilen yeni bir yöntemle kapalı olarak yapılmaktadır. Bu minimal invaziv Perkütan tekniği, geleneksel operasyonlara kıyasla hastalar için birçok avantaj sağlamaktadır. Bu yazıda, ayak ve ayak bileği ameliyatlarında kullanılan minimal invaziv Perkütan tekniği hakkında detaylı bilgiler sunulacak; Perkütan nedir, Perkütan ameliyatı nasıl uygulanır ve ayak ile ayak bileği ameliyatlarında hangi yenilikler ve avantajlar sunmaktadır.
                  <br>
                  <br>
                  Yazı, ayak ameliyatı olmayı düşünenler ya da bu konuda daha fazla bilgi edinmek isteyenler için faydalı bir kaynak olacaktır. Okumaya devam edin ve ayak-ayak bileği tedavilerinde minimal invaziv kapalı Perkütan ameliyatının farkını keşfedin.
                </p>
                <br>
                <br>
                <img src="/SaglikPusulam/assets/img/Kart7_2.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                <br>
                <p>
                <h4>Perkütan Nedir?</h4>
                <br>
                “Perkütan” kelimenin kök anlamına bakıldığında “deri geçişli” anlamına gelmektedir. Peki tıp alanında, perkütan nedir? Perkütan cerrahi, deri yoluyla iç dokulara delici bir giriş yapılarak gerçekleştirilen işlemleri ifade eder.
                <br>
                Bu yöntem kapalı ameliyat olarak da adlandırılabilir ve minimal invaziv bir tekniktir. Radyoloji, kardiyoloji ve ortopedi gibi çeşitli tıbbi alanlarda yaygın olarak kullanılmaktadır. Özellikle ortopedi alanında, ayak ve ayak bileği ameliyatları yüksek başarı oranı ve hasta memnuniyeti ile bu teknikle uygulanmaktadır.
                <br>
                Perkütan yöntemde, küçük bir alanda işlem yapabilmek için özel olarak geliştirilmiş aletler kullanılır. Bu özel aletleri kullanabilmek için cerrahların ek eğitim alması gerekmektedir; yani her cerrahın uygulayabileceği bir işlem değildir. Ayak ameliyatlarında, bu yöntemi uygulayacak olan ortopedi doktorların, tüm ayak cerrahisi tekniklerini bilmeleri ve yeterli tecrübeye sahip olmaları şarttır. Ayrıca, perkütan yöntemin uygulamalı eğitimini de almaları gerekmektedir.
                <br>
                Kapalı Perkütan ameliyat işlemler, geleneksel açık cerrahiye kıyasla daha az ağrı, daha kısa iyileşme süreleri, daha az yara izi ve daha düşük enfeksiyon riski sunmaktadır. Bu sebeplerle son yıllarda hem hastalar hem de cerrahlar tarafından giderek daha fazla tercih edilmektedir.
                <br>
                <br>
                <h4>Ayak Ameliyatında Perkütan Yöntem Nasıl Uygulanır?</h4>
                Perkütan yöntemle yapılan ayak ve ayak bileği ameliyatları, diğer ayak ameliyatı tekniklerine göre bazı özel farklılıklar taşır. Bu yöntemin temel özellikleri ve uygulama aşamaları şöyle sıralanabilir:
                <br><br>
                <h5>Minimal Kesiler Nedir?</h5>
                Perkütan teknik, ayak ve ayak bileği dokularına en az zarar vermek amacıyla, 3-5 mm’lik dört adet küçük cilt kesi ile gerçekleştirilir. Bu küçük kesiler sayesinde doku hasarı en aza indirgenir ve iyileşme süreci hızlanır.
                </p>
                <br>
                <img src="/SaglikPusulam/assets/img/Kart7_3.png" alt="" class="img-fluid mb-4" id="blog_img">
                <br>
                <p>
                  Perkütan yöntemi ile yapılan kapalı ameliyatlar, ayak bileği ve ayak ameliyatları gerektiren durumlarda, açık yöntemlere göre sağladığı avantajlar nedeniyle tercih edilen bir yöntemdir. İşte bu yöntemin ana faydaları şunlardır:
                  <br>
                <ol>
                  <li>
                    Minimum Yara İzi: Perkütan cerrahi, genellikle birkaç milimetre uzunluğunda çok küçük kesikler gerektirdiğinden, yara izi minimum düzeydedir. Perkütan yöntemin minimal invaziv yaklaşımla gerçekleştirildiğinde, yara izlerini azaltarak daha estetik bir görünüm sağlar.
                  </li>
                  <li>
                    Ameliyat Sonrası Azalan Ağrı ve Rahatsızlık: Kapalı ameliyatlar, kullanılan küçük kesikler sayesinde, geleneksel açık ameliyatlara kıyasla genellikle daha az ağrı ve rahatsızlığa neden olur. Bu, ağrı kesici ihtiyacını azaltabilir ve daha konforlu bir iyileşme süreci sağlar.
                  </li>
                  <li>
                    Daha Hızlı İyileşme: Perkütan cerrahi ile ayak ameliyatı olan hastalar genellikle daha hızlı iyileşir. Bu yöntem, hastaların normal aktivitelere daha erken dönmesine olanak tanır.
                  </li>
                  <li>
                    Çevre Dokulara Daha Az Zarar: Perkütan yöntemin hassasiyeti, çevredeki kaslar, tendonlar ve diğer yumuşak dokulara minimum hasar verilmesi anlamına gelir.
                  </li>
                  <li>
                    Enfeksiyon Riskinin Azalması: Daha küçük kesikler, ameliyat sonrası enfeksiyon riskini önemli ölçüde düşürür.
                  </li>
                  <li>
                    İyileşmiş Fonksiyonel Sonuçlar: Çevre dokulara ve yapılarına daha az travma ile hastalar genellikle daha iyi fonksiyonel sonuçlardan faydalanır. Bu, cerrahi sonrası <span style="text-decoration: underline;">ayak</span> ve ayak bileğinde daha fazla hareket ve esneklik korunmasını içerir.
                  </li>
                  <li>
                    Daha Kısa Hastane Yatışları: İşlemin minimal invaziv doğası ve daha hızlı iyileşme oranları nedeniyle, perkütan yöntemle ayak ameliyatları olanlar genellikle daha kısa hastane yatışları geçirmektedirler.
                  </li>
                  <li>
                    Yüksek Hassasiyet: Floroskopi gibi gelişmiş görüntüleme teknikleri yardımıyla cerrahlar, perkütan işlemleri yüksek bir hassasiyetle gerçekleştirebilirler. Bu görüntüleme, cerrahinin gerçek zamanlı olarak yönlendirilmesine izin vererek müdahalenin mümkün olduğunca doğru ve etkili olmasını sağlar.
                  </li>
                  <li>
                    Çok Yönlülük: Perkütan yaklaşım, <span style="text-decoration: underline;">halluks valgus</span> ve çekiç parmak gibi deformitelerin düzeltilmesi, küçük kemik çıkıntılarının çıkarılması ve belirli kırıkların ve yumuşak doku yaralanmalarının onarımı da dahil olmak üzere çeşitli ayak ve ayak bileği ameliyatları için kullanılabilir.
                  </li>
                </ol>
                </p>
                EOD
                ,
                'card_title' => 'Kapalı Ayak Ameliyatı Avantajları',
                'card_image' => 'artroskopik-ayak-bilegi-2.webp',
                'card_summary' => <<<'EOD'
                Ayak ağrıları ve ayak bileği sorunlarına çare arayan
                hastalar için, cerrahi müdahale adeta bir dönüm noktasıdır. Uzun yıllardır standart tedavi yöntemi
                olarak
                kabul edilen geleneksel ayak ameliyatları, iyileşme süreçlerinin uzunluğu, olası komplikasyon riskleri
                ve
                ameliyat sonrası sıklıkla yaşanan ayak ağrıları nedeniyle hastaları endişelendirmektedir.
                EOD
                ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'omuz-agrisinin-hastaliklarin-habercisi-olabilir',
                'title' => 'Omuz Ağrısı Ciddi Hastalıkların Habercisi Olabilir!',
                'content' => <<<'EOD'
                <img src="/SaglikPusulam/assets/img/Kart8_1.jpg" alt="" class="img-fluid mb-4 blog_img_head">
                <br>
                <p>
                <h4>Omuz eklem ağrısı</h4>
                <br>
                Omuz eklemi de diz eklemi gibi vücuttaki en büyük ve karmaşık eklemlerden biridir. Omuz eklemi, üst kol kemiğinin kürek kemiğiyle birleştiği yerde oluşur. Tıpkı bir topun yuvaya oturmasına benzeyen eklem yapısı olmasına karşın, yuva bölümü yeterince derin değil sığdır. Omuz ekleminde oluşan bir hasar özgürce hareket etme yeteneğinizi engelleyerek, ağrı ve rahatsızlığa neden olabilir. Omuz ağrısı, erişkinlerde sık rastlanan bir problemdir. Bununla birlikte, kişilerin yaşadığı ağrı türü ve şiddeti her zaman aynı olmamaktadır. Farklı omuz yaralanmaları, farklı ağrılı durumlara neden olur. Bir kas, bağ veya tendonların aşırı gerilmesi sonucu birden gelişen ağrı yani ani-akut omuz ağrısı oluşabilir. Akut ağrı tedavi edilemez veya uzun süre devam ederse süregen-kronik ağrıya dönüşür. Omuz sorunlarında omuzda oluşan ağrı ile birlikte; kol, dirsek, boyun ve sırt gibi diğer bölgelerde de ağrı hissedilebilir.
                <br>
                <br>
                <h4>Omuz hastalıklarındaki yakınmalar nelerdir?</h4>
                <br>
                Omuz ağrısının farklı türleri ve şiddeti olabilir. Bu durum, omuz ağrısına neden olan duruma da bağlıdır. Omuz ağrısı, boyuna ve kolla kadar yayılabilir. Yayılan ağrı genellikle kollar hareket ettirilirken veya dinlenme halindeyken hissedilir. İltihaplı romatizmal hastalığı olan kişiler, özellikle ağır egzersiz yaptıklarında veya kollarını aşırı kullandıklarında genellikle sırtlarında rahatsızlık hissi veren bir ağrı yaşarlar. Ayrıca eklem bölgesindeki şişlik, kaslarda gerginliğe veya spazmlara neden olabilir. Düşme, omuza darbe veya spor yaralanmaları sancılı omuz ağrısına neden olabilir. Sancılı omuz ağrısı genellikle; kas, tendon veya yumuşak dokulardaki zedelenmeler nedeniyle oluşur. Bu zedelenmeler omuza alınan darbeler, yapılan ters hareketler veya omuzu aşırı zorlayan hareketler nedeniyle meydana gelebilir.
                </p>
                <br>
                <br>
                <img src="/SaglikPusulam/assets/img/Kart8_2.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                <br>
                <p>
                <h4>Omuz ağrısı nedenleri nelerdir?</h4>
                <br>
                Omuz ağrısı, sık görülen eklem ağrılarındandır. Özellikle kollarını yoğun kullanarak çalışan kişilerde ve omuzu zorlayan sporlar ile uğraşan kişilerde daha da sık görülür. Omuz ağrısı ve beraberindeki hareket kısıtlılığı kişilerin yaşam kalitesini olumsuz etkiler. Omuz ağrısına pek çok durum neden olabilir. Omuz ağrısı, omuz eklemine ait sorunlardan kaynaklanabileceği gibi diğer pek çok rahatsızlığın bir belirtisi olarak da meydana gelebilir.
                <br>
                <br>
                <h4>Omuz sıkışma sendromu</h4>
                <br>
                Omuz eklemi günlük yaşam sırasında aktif olarak yoğun şekilde kullanılır. Kolun öne, arkaya ve yana hareketlerini sağlayan kasların kemikler ve bağlar arasında sıkışması sonucu omuz sıkışma sendromu meydana gelir. En sık görülen omuz ağrısı nedeni sıkışma sendromudur. Ağrılar sıklıkla omuzun ve kolun sık kullanılması sonucu ortaya çıkar. Zamanla ağrı devamlı olmaya başlar. Özellikle geceleri hastayı uyutmayan omuz ağrıları meydana gelebilir.
                </p>
                <br>
                <br>
                <img src="/SaglikPusulam/assets/img/Kart8_3.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                <br>
                <p>
                <h4>Omuz tendon bozuklukları</h4>
                <br>
                Tendinopati: Tendon-kiriş, güçlü halat gibi kasları kemiğe bağlayan yapılardır. Tendonlardaki bozukluklar genel olarak tendinopati olarak isimlendirilir.
                <br>
                Tendondaki sorun aniden-akut gelişebilir; iş veya spor sırasında aşırı top atma veya diğer baş üstü aktiviteler akut tendinite neden olabilir.
                <br>
                Tendondaki sorun süregen-kronik olabilir; kireçlenme gibi dejeneratif hastalıklar veya yaşa bağlı tekrarlayan yıpranma ve aşınma kronik tendinozise neden olabilir.
                <br>
                Omuzda en sık ağrılı duruma neden olan tendonlar; rotator manşet tendonu ve biseps tendonudur. Hastalar genellikle tendiniti ilk başta fark etmeyebilirler. Başlangıçta küçük bir ağrı ve adalelerde hafif bir güç kaybı ile kendini gösterir. İlerleyen zamanlarda, omuzda hareket kısıtlılığı meydana gelebilir.
                <br>
                <br>
                Rotator manşet yırtığı: Omuz eklemini sabit tutmak ve hareket ettirmek için beraber çalışan kas ve tendon grubuna rotator manşet denir. Omuz ağrılarına birçok neden yol açabilir, ancak rotator manşeti oluşturan kas ve tendon grubundaki yaralanmalar akla ilk gelen nedenler arasındadır. Rotator manşet bozuklukları, 30 yaşın üzerindeki kişilerde omuz ağrısının en yaygın nedenidir. Rotator manşetten kaynaklanan ağrı genellikle zorlanmaya bağlı olarak gelişen tendinit ya da rotator manşet yırtığı nedeniyle görülür. Tendonların ayrılması ve yırtılması, ilerleyen yaş, uzun süreli aşırı kullanım ve yıpranma veya ani bir yaralanma nedeniyle akut yaralanma veya tendonlardaki dejeneratif değişikliklerden kaynaklanabilir. Bu yırtıklar kısmi olabilir veya tendonu kemiğe yapışmasından tamamen ayırabilir.
                <br>
                <br>
                <h4>Omuzun bursitleri</h4>
                <br>
                Bursa kesesi, omuz da dahil olmak üzere vücuttaki eklemlerde bulunan küçük, sıvı dolu yapılardır. Kemikler ve yumuşak dokular arasında yastık görevi gören bu keseler kaslar ile kemik arasındaki sürtünmeyi azaltmaya yardımcı olur. Bazen omuzların aşırı kullanımı, rotator manşet ile kemik arasında bursa kesesinin iltihaplanmasına yol açar. Böylece kesenin içindeki sıvının artıp şişmesi sonucu bursit denilen durum ortaya çıkar. Omuzda meydana gelen bursitler, özellikle kol hareketleriyle şiddetlenen çok ağrılı bir tablo oluşmasına neden olurlar.
                </p>
                <br>
                <br>
                <img src="/SaglikPusulam/assets/img/Kart8_4.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                EOD
                ,
                'card_title' => 'Omuz Ağrısı Hastalıkların Habercisi Olabilir!',
                'card_image' => 'banner-1500.jpg',
                'card_summary' => <<<'EOD'
                Omuz eklemi de diz eklemi gibi vücuttaki en büyük ve
                karmaşık eklemlerden biridir. Omuz eklemi, üst kol kemiğinin kürek kemiğiyle birleştiği yerde oluşur.
                Tıpkı bir topun yuvaya oturmasına benzeyen eklem yapısı olmasına karşın, yuva bölümü yeterince derin
                değil
                sığdır.
                EOD
                ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'topuk-dikeni-egzersizleri',
                'title' => 'Topuk Dikeni Egzersizleri: Evde Uygulayabileceğiniz 11 Egzersiz',
                'content' => <<<'EOD'
                                <img src="/SaglikPusulam/assets/img/Kart9_1.png" alt="" class="img-fluid mb-4 blog_img_head">
                 <br>
                 <p>
                    Topuk dikeni, topukta şiddetli ağrılara yol açan ve birçok gündelik yaşam
                    aktivitesini kısıtlayan bir rahatsızlıktır. Özellikle sabahları uyandığınızda
                    ya da uzun süre hareketsiz kaldığınızda, ilk adımı atmak çok ağrılı olabilir.
                    Topuk dikeni, birçok nedenden kaynaklanabilir. Düztaban rahatsızlığı, kas
                    gücünün zayıflaması, uzun süre ayakta kalma, fiziksel olarak zorlama veya
                    uygun olmayan ayakkabılar giyme bu nedenlerden bazılarıdır.
                    <br>
                    Topuk dikeninin tedavisinde çoğunlukla cerrahi müdahaleye gerek
                    kalmaz. Konservatif tedavi yöntemleri, topuk dikeni tedavisinde
                    oldukça etkili olabilmektedir. Bu yöntemler içerisinde bulunan
                    egzersizler de ilk başvurulan tedavilerden biridir.



                    <br>
                    <br>
                    <h4>Topuk Dikeni (Plantar Fasiit) Egzersizleri Nasıldır?</h4>
                    <br>
                    Egzersizler, germe ve güçlendirme egzersizleri olarak ikiye ayrılabilir.
                    Topuk dikeni germe egzersizleri; kaslardaki esnekliği artırmak,
                    sertliği yumuşatmak ve yorgunluğu gidermek için faydalıdır.
                    Güçlendirme egzersizleri ise kasların dayanıklılığını artırarak hareketlerin
                    daha dengeli gerçekleştirilmesinde etkilidir.
                    <br>
                    Germe ve güçlendirme egzersizlerinden hangisinin daha etkili olduğu hakkındaki çalışmalar
                    oldukça azdır. Ancak genellikle egzersiz programında ikisi de yer alır.
                    Yine de bu konuda doktorunuza başvurmanız en doğrusu olacaktır.
                    <br>
                    Topuk dikeni egzersizleri rahatlıkla evde uygulanabilir.
                    Çoğu egzersizi ekipman kullanmadan ya da evde bulabileceğiniz
                    eşyalarla gerçekleştirebilirsiniz. Doğru bir şekilde
                    uyguladığınızda ve egzersiz programınızı aksatmadığınızda
                    ağrılarınız büyük oranda azalacaktır.
                 </p>
                 <br>
                 <br>
                 <img src="/SaglikPusulam/assets/img/Kart9_2.webp" alt="" class="img-fluid mb-4" id="blog_img">
                 <br>
                 <br>
                 <p>
                  <h4>Topuk Dikeni Egzersizleri</h4>
                  <br>
                  <h5>1. Baldır Germe Egzersizi</h5>
                  <br>

                  Ayak kaslarındaki ve baldırdaki gerginlik, topuk dikeni ağrısını daha şiddetli
                  bir hale getirebilir. Bu yüzden baldır kaslarını esneklik kazandırmak acıyı
                  azaltabilir.
                  <br>
                  <br>
                  <h5>2. Ayak Altında Top Yuvarlama Egzersizi</h5>
                  <br>
                  Ayak altında top yuvarlamak, ayak kaslarını gevşetmenize yarar.
                  Top yerine dondurulmuş bir şişe su da kullanabilirsiniz.
                  Bu şekildeki soğuk uygulama ile enflamasyonu da azaltabilirsiniz.
                  Bir sandalyeye oturun.
                  <br>
                  <br>
                  <h5>3. Otururken Ayak Germe Egzersizi</h5>
                  <br>
                  Bu topuk dikeni egzersiziyle kas gerginliğinizi rahatlatabilirsiniz.
                  <br>
                  <br>
                  <h5>4. Ayak Parmaklarıyla Nesne Tutup Bırakma Egzersizi</h5>
                  <br>
                  Ayak parmaklarınızla nesne tutmak, ayak ve baldır kaslarınızın gerilmesini sağlar.
                  Bu egzersiz, günün ilk adımını atmadan önce veya gün içinde dinlenmenin ardından
                  yapılabilir. İlk adım attığınızda hissedilen ağrı için oldukça rahatlatıcıdır.
                  <br>
                  <br>
                  <h5>5. Topuk Dikeni Masajı</h5>
                  <br>
                  Ayak tabanına masaj uygulayarak bölgedeki kasların gevşemesini ve ağrıların
                  azalmasını sağlayabilirsiniz. Ayrıca masajla kan dolaşımını artırabilir,
                  bölgenin iyileşmesine destek olabilirsiniz.
                  <br>
                  <br>
                  <h5>6. Elastik Bant ya da Havlu ile Ayak Germe Egzersizi</h5>
                  <br>
                  Elastik bant ya da havluyla yapılan germe egzersizi, ulaşılması zor
                  olan kaslar için oldukça uygundur. Ayrıca tendonun da esnetilmesini
                  sağlar. Bu topuk dikeni egzersizi; ayak tabanı, ayak bölgesi ve
                  baldırdaki kaslara etki göstererek geniş çaplı bir etki sağlayabilir.
                  <br>
                  <br>
                  <h5>7. Oturarak Ayağı İçe Döndürme Egzersizi (Elastik Bant ile)</h5>
                  <br>
                  Elastik bant ile yapılabilen bu egzersiz, ayak bileği çevresindeki kasların
                  güçlendirilmesinde etkilidir. Kasların güçlenmesi, ayak taban zarı olan plantar
                  fasya üzerine binen yükün azalmasını sağlayabilir. Böylece ağrıyan bölge
                  üzerindeki baskı azalır.
                 </p>

                 <br>
                 <br>
                 <img src="/SaglikPusulam/assets/img/Kart9_3.webp" alt="" class="img-fluid mb-4" id="blog_img">
                 <br>
                 <p>
                    <h5>8. Topuk Kaldırma Egzersizi</h5>
                    <br>
                    Topuk kaldırma egzersizi, baldırın güçlenmesi için etkilidir. Gündelik yaşamda
                    daha aktif olmak ve zorlamayacak düzeydeki sporlara geri dönmek için önerilen
                    bir egzersizdir. Çünkü baldırın güçlenmesiyle; yürüme, koşma gibi aktivitelerde,
                    ayağın yerle temasında aldığı darbeler azalır.
                    <br>
                    <br>
                    <h5>9. Ayak Parmaklarıyla Havlu Sıkma Egzersizi</h5>
                    <br>
                    Topuk dikeninden dolayı zayıflayan kasların güçlendirilmesi çok
                    önemlidir. Ayak parmaklarının aktif olarak kullanıldığı bu
                    egzersizde, ayağın içinde bulunan kaslar çalışır. Ayrıca ayakta
                    bulunan arklara destek sağlanır.
                    <br>
                    <br>
                    <h5>10. Oturarak Ayak Parmaklarınızı Germe Egzersizi</h5>
                    <br>
                    Topuk dikeninden dolayı ayak tabanında gerginlik oluşabilir.
                    Bu gerginliği gidermek için yapılan ayak parmaklarını germe egzersiziyle ağrılar
                    hafifleyebilir. Özellikle sabahları ya da uzun süre oturduktan sonraki yaşanan
                    şiddetli ağrılarda etkili olabilir.
                    <br>
                    <br>
                    <h5>11. Masaj Köpüğü ya da Yuvarlama Köpüğü ile Egzersiz</h5>
                    <br>
                    Baldır kaslarına uygulanan bu egzersiz, kaslardaki gerginliği ve
                    sıkılığı çözmeye yardımcı olur. Bu sayede Aşil tendonu ve ayak
                    tabanına binen yük de azalabilir. Böylece ağrıların hafiflemesinde
                    etkili olabilir.
                    <br>
                    <br>
                    <h4>Sonuç</h4>
                    <br>
                    Topuk dikeni için egzersiz uygulamak, etkili bir tedavi yöntemidir.
                    Ancak egzersizlerin düzenli ve doğru bir şekilde uygulanması gerekmektedir.
                    Aksi taktirde istenen sonuç alınamayabilir. Eğer topuk dikeni şikâyetiniz varsa ve
                    hayatınızdaki birçok aktiviteyi gerçekleştirmekte zorlanıyorsanız bizimle
                    iletişime geçebilirsiniz. Merak ettiklerinizi sorabilir,Ortopedi ve Travmotoloji
                    noktorlarımızdan randevu alabilirsiniz.

                 </p>
                EOD
                ,
                'card_title' => 'Topuk Dikeni Egzersizleri Nelerdir?',
                'card_image' => 'topuk-dikeni-egzersizleri.png',
                'card_summary' => <<<'EOD'
                Topuk dikeni, topukta şiddetli ağrılara yol açan ve birçok
                günlük yaşam aktivitesini kısıtlayan bir rahatsızlıktır. Özellikle sabahları uyandığınızda ya da uzun
                süre
                hareketsiz kaldığınızda, ilk adımı atmak ağrılı olabilir. Topuk dikeni, birçok nedenden kaynaklanabilir.
                EOD
                ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'impingement-sendromu-icin-omuz-egzersizleri',
                'title' => 'İmpingement Sendromu İçin Omuz Egzersizleri',
                'content' => <<<'EOD'
                <img src="/SaglikPusulam/assets/img/Kart10_1.png" alt="" class="img-fluid mb-4 blog_img_head">
                <br>
                <p class="col-lg-11 col-md-8 mb-7">
                  Omuz sıkışması veya diğer bilinen adıyla impingement sendromu, omuzdaki tendonların özellikle rotator cuff tendonlarının omuz kemikleri arasında sıkışması sonucunda meydana gelir. Bu durum, omuz hareketleri sırasında, özellikle yukarı kaldırıldığında, ağrıya; belirli pozisyonlarda zorlanmaya; güç kaybına ve omuzda takılma veya sıkışma hissine yol açabilir. Omuz impingement sendromu, omuz ağrısı şikayetlerinin en yaygın nedenlerinden biridir ve özellikle belirli yaş ve meslek gruplarında daha sık görülür. Yüzme, beyzbol, tenis gibi omuzlarını sıkça kullanan sporcular bu sendroma daha yatkındır. Bu tür sporlar, omuz eklemi ve tendonları üzerinde sürekli ve yoğun baskı oluşturur. Ayrıca, boya badana yapma, inşaat işleri veya cam temizleme gibi kollarını sıkça yukarı kaldıran işlerde çalışan kişilerde impingement sendromu riski daha yüksektir.
                  <br>
                </p>
                <h4>
                  Omuz İmpingement Sendromunun Tedavi Yöntemleri
                </h4>
                <p>
                  Omuz impingement sendromunun tedavisi, hastanın şikayetlerinin şiddetine, süresine ve etkilediği yaşam kalitesine göre belirlenir. Tedavi genellikle cerrahi olmayan (konservatif) yöntemlerle başlar: Dinlenme ve aktivite düzenlemeleri, fizik tedavi, ilaçlar ve enjeksiyonlar. Ancak, konservatif tedavilere yanıt vermeyen veya kronikleşmiş vakalar için cerrahi yöntemler değerlendirilir. Omuz impingement sendromunun tedavisinde fizik tedavi ve egzersiz programları önemli bir role sahiptir. Yapılan çalışmalar, fizik tedavi ve düzenli omuz egzersizlerinin kısa vadeli ağrı azalması ve fonksiyonel iyileşme sağladığını göstermektedir: Bu uygulamalar kısa vadede omuz ağrısını önemli ölçüde azaltabilir ve omuzun fonksiyonel kapasitesini artırabilir. Uzun vadeli yararlar açısından, düzenli ve doğru uygulanan omuz egzersizleri, omuz sağlığını koruyarak tekrarlayan sorunların önüne geçebilir ve bazı hastalarda cerrahiye gerek kalmadan iyileşme sağlayabilir. Fizik tedavi ve egzersizler, omuz impingement sendromu tedavisinde hastanın durumuna ve ihtiyaçlarına özel olarak düzenlendiğinde oldukça etkilidir. Ancak en iyi sonuçlar için, bir fizyoterapist rehberliğinde bireysel olarak tasarlanmış bir tedavi programının uygulanması önerilir.
                </p>
                <img class="fixed-size" src="/SaglikPusulam/assets/img/Kart10_2.png" alt="" class="img-fluid mb-4" id="blog_img">
                <br><br><br>
                <h4>
                  Evde Yapabileceğimiz Omuz Egzersizleri Öncesi:
                </h4>
                <p>
                  Omuz egzersizlerine başlamadan önce fizik tedavi uzmanına muayene olmak ve onun önerileri doğrultusunda fizik tedavi egzersizlerine ve omuz hareketlerine başlamak çok önemlidir. Özellikle omuz impingement sendromu gibi spesifik tıbbi durumlar söz konusu olduğunda, bu kritik bir adımdır. Çünkü:
                </p>
                <h4>
                  Omuz Ağrısının Kaynakları Çeşitlidir
                </h4>
                <p>
                  Omuz ağrısı, rotator cuff yırtıkları, artrit, bursit gibi birçok farklı durumdan kaynaklanabilir. Her bir durumun gerektirdiği tedavi yöntemi ve fizik tedavi egzersizi farklıdır.
                </p>
                <h4>
                  Kişiselleştirilmiş Tedavi Planları
                </h4>
                <p>
                  Fizik tedavi uzmanı, doğru teşhis koyarak uygun tedavi planını belirleyebilir. Ayrıca, her hastanın sağlık durumu, yaşam tarzı ve fiziksel kapasitesi farklıdır; bu yüzden bir fizik tedavi uzmanı ve fizyoterapist, hastanın özel ihtiyaçlarına uygun bir egzersiz programı hazırlayabilir.
                </p>
                <h4>
                  Yanlış Egzersiz Tekniklerinin Riskleri
                </h4>
                <p>
                  Yanlış egzersiz teknikleri, özellikle omuz gibi hassas bir bölgede yapıldığında, mevcut durumu kötüleştirebilir veya yeni yaralanmalara neden olabilir. Fizyoterapist rehberliği, doğru şekilde egzersiz yapmak ve kötüleşmeyi önlemek için kritik bir rol oynar.
                </p>
                <h4>
                  Kapsamlı Ağrı Yönetimi
                </h4>
                <p>
                  Bazı durumlarda, impingement sendromu tedavisinde egzersizlerin yanı sıra ağrı yönetimi için ilaçlar da gerekebilir. Fizik tedavi uzmanı, hangi ilaçların kullanılacağı ve dozları hakkında bilgilendirme yapabilir. Bu nedenlerden ötürü, egzersizlere başlamadan önce fizik tedavi uzmanı ile görüşmek sadece güvenlik açısından değil, aynı zamanda tedavinin etkinliği ve uygunluğu açısından da büyük önem taşımaktadır.
                </p>
                <img class="fixed-size" src="/SaglikPusulam/assets/img/Kart10_3.webp" alt="" class="img-fluid mb-4" id="blog_img">
                <br><br><br>
                <h4>
                  Omuz Sıkışması Evde Tedavi: Omuz Sıkışması Egzersizleri
                </h4>
                <p>
                  Omuz impingement sendromu için egzersizler, omuzdaki ağrıyı azaltmayı, omuz hareket aralığını genişletmeyi ve omuz çevresindeki kasları güçlendirmeyi hedefler. Bu egzersizler farklı türlerde olup; izometrik egzersizler, omuz güçlendirme egzersizleri, kürek kemiği (skapula) egzersizleri ve esnetme egzersizleri şeklinde ayrılır. Aşağıda, bu egzersizlerin nasıl yapıldığını resimler üzerinden ayrıntılı bir şekilde bulabilirsiniz. Bu bölümde, evde uygulayabileceğiniz çeşitli kol ve omuz hareketlerinden bahsedeceğiz. Egzersizlerin adımlarını dikkatlice okuyup görsellerini inceleyerek siz de bu egzersizleri yapabilirsiniz. Aktif kalmak, omuz sıkışması sendromunun en etkili tedavilerinden biridir. Size en uygun egzersizleri, yapabileceğiniz seviyede uyguladığınızda iyileşme süreciniz hızlanacaktır.
                </p>
                <h4>
                  Omuz İmpingement Sendromunda İzometrik Egzersizler (Direnç)
                </h4>
                <p>
                  İzometrik Egzersizlerin (Direnç) amacı, herhangi bir şekilde hareket ettirmeden, germeden, belirli kasların gücünü ve dayanıklılığını geliştirmeye yardımcı olur. İzometrik egzersizler, özellikle akut ağrı dönemlerinde kullanılır çünkü bu egzersizler sırasında eklemde hareket olmaz ve bu da ağrının artmasını önler.
                </p>
                EOD
                ,
                'card_title' => 'İmpingement Sendromu İçin Omuz Egzersizleri',
                'card_image' => 'impingement-sendromu-egzersizleri.png',
                'card_summary' => <<<'EOD'
                Omuz sıkışması veya diğer bilinen adıyla impingement
                sendromu, omuzdaki tendonların özellikle rotator cuff tendonlarının omuz kemikleri arasında sıkışması
                sonucunda meydana gelir. Bu durum, omuz hareketleri sırasında, özellikle yukarı kaldırıldığında, ağrıya;
                belirli pozisyonlarda zorlanmaya; güç kaybına ve omuzda takılma veya sıkışma hissine yol açabilir.
                EOD
                ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'durus-bozuklugunu-egzersizleri',
                'title' => 'Duruş Bozukluğunu (Postür) Düzeltmek İçin Yapabileceğiniz Egzersizler',
                'content' => <<<'EOD'
                <img src="/SaglikPusulam/assets/img/Kart11_1.png" alt="" class="img-fluid mb-4 blog_img_head">
                <br>
                <p>
                  Günlük hayatımızda uzun süre masa başında çalışmak, telefon kullanımının artması ve yaş faktörüne bağlı çeşitli nedenlerle kişiler yanlış duruş pozisyonları sergilemektedir. Söz konusu durum ise duruş bozukluğuna neden olmaktadır. Uzun süreli duruş bozuklukları kas-eklem ağrılarına neden olurken aynı zamanda bireylerin yaşam kalitesini düşürmektedir. Doğru duruş dik durmaktan daha fazlası olup uzun dönemli sağlığı etkilemektedir. İnsan vücudunu bir bütün olarak ele aldığımızda bu yapının zincirleme bir sistem olduğu ve herhangi bir halkanın hasar görmesi durumunda tüm sistemin etkilendiği gözlenmektedir. Örneğin; günlük yaşamında kambur duruş pozisyonu sergileyen bir kişinin omuzları öne doğru yuvarlanmakta ve bu durum göğüs kafesine baskıyı artırarak nefes güçlüğüne neden olmaktadır. Nefes güçlüğü beraberinde karın kaslarının kısalmasına sırt ve bel kaslarının ise uzayarak güç kaybetmesine neden olmaktadır. İlerleyen süreçte ise ayak, kalça ve dizlerde sorunlar yaşanabilmektedir. Vücudumuz hareketsiz ya da hareketli konumdayken doğru pozisyonda durmak ağrı ve diğer sağlık sorunlarının oluşmasını önleyebilir.
                  <br>
                  <br>
                  <h4>Duruş (Postür) Nedir?</h4>
                  <br>
                  Postür diğer bir ifadeyle duruş, oturur pozisyonda ya da ayaktayken vücudumuzun aldığı pozisyon olarak ifade edilmektedir. Vücut kısımlarının (omurga, baş, omuz, kalça vd.) duruş ve düzenini açıklamakta olup 2 (iki) gruba ayrılmaktadır. Bunlar; Dinamik Duruş (Hareketli Duruş): Hareket halindeyken (yürüme, koşma, eğilme vb.) vücudun duruş biçimidir. Statik Duruş (Sabit Duruş): Hareket halinde değilken (oturma, ayakta durma, uyuma vb.) vücudun duruş biçimidir. Doğru postür, eklemlere uygulanan kuvvettin eşit ve dengeli dağıldığı ve vücudun normal eğriliklerini korumakta olduğu duruş şeklini ifade etmektedir. Kısaca iyi bir duruşun temelinde omurganın pozisyonu önemlidir. Kişilerin postür yapılarına etki eden faktörler ise yaş, cinsiyet, beslenme şekilleri, kalıtım, meslek, sosyal ve durum gibi çeşitli değişkenlere bağlı olabilmektedir.
                </p>
                <br>
                <br>
                <img src="/SaglikPusulam/assets/img/Kart11_2.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                <br>
                <h4>Duruşumu Nasıl Daha İyi Bir Hale Getirebilirim?</h4>
                <br>
                <p>
                  Duruşunuza dikkat edin. Günlük aktivitelerinizi gerçekleştirirken (bulaşık yıkama, televizyon izleme, yürüme gibi) vücudunuzun duruşuna dikkat edin. Ayakta dururken postürünüzü düzeltmek için ise; Dik durun ve omuzlarınızı geride tutun Midenizi içeri çekin Vücut ağırlığınızı topuklarınıza verin Kafa seviyenizi koruyun Ayaklarınızı yaklaşık omuz genişliğinde açık tutun Kilonuzu kontrol altında tutun. Fazla kilolar omurga ve pelvisinizde sorunlara ve bel ağrısına sebep olabilir. Rahat ayakkabılar tercih edin. Topuğu yüksek olan ayakkabılar kişilerin yürümesini zorlaştırarak kaslara baskı uygulamakta ve bu durum ise duruş bozukluklarına neden olabilmektedir. Oturma pozisyonunuzu ayarlayın. Günlük hayatınızda yemek yerken ya da bilgisayar başında çalışırken çalışma yüzeylerinin yüksekliğinin rahat olmasına dikkat edin. Oturma pozisyonunuzu 30 dakika aralıklarla değiştirin. Ayaklarınızın yere değmesine özen gösterin. Omuzlarınızı gevşek tutun. Sırtınızın alt kısmının destekleniyor olmasına dikkat edin. Egzersiz yapın. Postür düzeltmede en önemli olan faktörlerden biri ise egzersiz hareketlerinin uygulanmasıdır.
                </p>
                <br>
                <p>
                  Duruş bozukluğu tedavisinde oturarak, ayakta ve yatarak uygulanan egzersizler oldukça önemlidir. Ancak yeterli değildir. Duruş bozukluğunun belirlenmesi için öncelikli olarak kişilerin Ortopedi ve Travmatoloji servislerine başvurarak hangi tip duruş bozukluğu yaşadıkları tespit edilmelidir. Sonraki süreçte ise fizik tedavi ya da cerrahi tedavi seçeneklerinin yanında egzersizler destekleyici tedavi olarak uygulanabilir. Egzersizlerin doğru bir şekilde uygulanabilmesi ve olası sakatlanmaların önlenmesi için egzersizlere bir doktor tavsiyesi ile başlanması önerilmektedir.
                </p>
                <br>
                EOD
                ,
                'card_title' => 'Duruş Bozluğu Düzeltmenin Yolu',
                'card_image' => 'postur.png',
                'card_summary' => <<<'EOD'
                Günlük hayatımızda uzun süre masa başında çalışmak,
                telefon
                kullanımının artması ve yaş faktörüne bağlı çeşitli nedenlerle kişiler yanlış duruş pozisyonları
                sergilemektedir. Söz konusu durum ise duruş bozukluğuna neden olmaktadır.
                EOD
                ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'kar-kurerek-dikkatli-olunmasi-gerekenler',
                'title' => 'Kar Kürerken Sırtımıza Zarar Vermekten Kaçınmanın Yolları',
                'content' => <<<'EOD'
                <img src="/SaglikPusulam/assets/img/Kart12_1.jpg" alt="" class="img-fluid mb-4 blog_head_img">
                <br>
                <p>
                  Kar yağışıyla birlikte hepimiz çevremizi zarif şekilde örten beyazlığın tadını çıkarmak istiyoruz. Ancak, kar her ne kadar güzel ve eğlenceli olsa da kayarak düşmeler başta olmak üzere çeşitli riskleri de beraberinde getirebilir. Yaşadığımız yere göre günler, haftalar hatta aylar süren kar yağışı hayatı zorlaştırabilir. Evimizin önünü, arabamızın etrafını temizlemek için kar küremek zorunda kalabiliriz. Kar kürerken doğru tekniği kullanmamak bel ve sırt ağrılarına yol açabilir.
                </p>
                <br>
                <p>
                  Kış mevsiminde kas yorgunluğu, bel gerginliği, fıtıklaşmış disk ve hatta omurga kırıkları gibi sorunların artması şaşırtıcı değildir. Kayma ve düşme gibi kazalar sonucu omurga yapısında hasar oluşabilir. Yanlış teknikle kar küremek de bel ve sırt ağrısının yaygın bir nedenidir. Ayrıca, var olan sırt ağrınızın şiddetlenmesine neden olabilir.
                </p>
                <br>
                <img src="/SaglikPusulam/assets/img/Kart12_2.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                <br>
                <br>
                <p>
                  Yanlış teknikle kar küremek omurga üzerinde baskı ve hasara yol açarak bel ve sırt ağrılarına veya var olan ağrıların şiddetlenmesine neden olabilir. Basit ve doğru kar küreme tekniklerini kullanmak, bel ve sırt ağrılarını ve yaralanmaları önlemenize yardımcı olacaktır. Kar kürerken sırtımıza zarar vermekten kaçınmanın yolları ve bazı ipuçları:
                </p>
                <br>
                <h4>Kar küremek için doğru zamanı seçin</h4>
                <br>
                <p>
                  Günün bazı saatleri ve belirli hava koşulları kar küremek için daha uygun olabilir. Kar küremek için uygun koşulları arıyorsanız yediğiniz yemek bile önemli bir faktör olabilir. Kar küremek için doğru zamanı seçerken şunlara dikkat edin:
                </p>
                <p>• Sabahın erken saatlerinde veya uykudan uyandıktan hemen sonra kar küremekten kaçının. Bu süre zarfında, omurilik diskleri maksimum düzeyde hidratlanır (su molekülleri ile çevrilir) ve fıtıklaşma riski daha fazla olabilir.</p>
                <p>• Kar küremek için en iyi ve en güvenli zaman kar yağışı bittikten sonradır. Kar yağışı bittikten sonra ne kadar kar temizlemeniz gerektiğini görebilirsiniz. Ancak, devam eden yoğun kar yağışı varsa biriken kar miktarı fazla olmaması için aralıklarla kar küremek işinizi kolaylaştırabilir.</p>
                <p>• Buzda kayma riskini azaltmak için kaldırım veya araba yoluna kum veya kaya tuzu serpebilirsiniz.</p>
                <p>• Ağır bir yemek yedikten veya alkol tükettikten sonra kar küremekten kaçının.</p>
                </p>
                <p>
                  Kar küremeden önce vücudunuzu hazırlayın. Kürekle kar temizlemeyi bir aerobik egzersiz şekli olarak düşünebilirsiniz. Herhangi bir egzersize başlamadan önce ısınma hareketleri yaptığımız gibi kar küremeden önce de vücudu ve kasları hazırlamak önemlidir.
                </p>
                <p>• Isınma hareketleri yapın. Vücudunuzu ısıtmak ve kan akışını sağlamak için 5-10 dakika ayırın. Sırtınızı ve hamstring kaslarını (arka uyluk kasları) hedef alan basit esneme hareketleri ile başlayabilir ve seçtiğiniz temel egzersizlerden 10 tekrarlı bir set yapabilirsiniz.</p>
                <p>• Su için. Soğuk havalarda susadığınızı daha az hissedersiniz. Bu nedenle, kışın yorucu fiziksel aktivitelerde vücudunuzun susuz kalma (dehidrasyon) riski artabilir ve vücudun ısıyı düzenleme yeteneği bozulabilir. Kar küremeden önce su içerek bu riski önleyebilirsiniz.</p>
                <p>
                  Kar ve soğuk hava için uygun giyindiğinizden emin olun. Soğuk havalarda kan damarları daralır ve kar küreme sırasında sürekli çalışan aktif kaslara giden kan akışı azalabilir. Yalıtkan, sıcak tutan ve su tutmayan giysiler giymek vücudun sıcak kalmasına yardımcı olarak oksijen tedarikini ve kan akışını iyileştirebilir (Resim 2). Kar için uygun giysiler giydiğinizden emin olmak için aşağıdaki önerileri göz önünde bulundurabilirsiniz:
                </p>
                <p>• Kalın palto, pantolon, şapka, eldiven ve kulaklık giyin.</p>
                <p>• Hareket etmesi kolay giysiler tercih edin.</p>
                <p>• Şapka veya atkıyı görüşünüzü engellemeyecek şekilde takın.</p>
                <p>• Ayakları sıcak ve kuru tutacak, aynı zamanda kaymanızı önleyecek botlar giyin.</p>
                <br>
                <img src="/SaglikPusulam/assets/img/Kart12_3.jpg" alt="" class="img-fluid mb-4" id="blog_img">
                <br>
                EOD
                ,
                'card_title' => 'Kar Kürerken Dikkatli Olunması Gerekenler',
                'card_image' => 'kar-kurerken-sirtimiza-zarar-vermekten-kacirmanin-yollari.jpg',
                'card_summary' => <<<'EOD'
                Kar yağışıyla birlikte hepimiz çevremizi zarif şekilde
                örten beyazlığın tadını çıkarmak istiyoruz. Ancak, kar her ne kadar güzel ve eğlenceli olsa da kayarak
                düşmeler başta olmak üzere çeşitli riskleri de beraberinde getirebilir.
                EOD
                ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
