# 🏥 Sağlık Pusulam - Backend API

Sağlık Pusulam, kullanıcıların sağlık hizmetlerini kolayca bulabilecekleri, değerlendirebilecekleri ve karşılaştırabilecekleri modern bir platformun backend API'sidir.

## 🚀 Özellikler

- **🔍 Gelişmiş Sağlık Hizmeti Arama**
  - İl ve ilçe bazlı arama
  - Uzmanlık alanına göre filtreleme
  - Sağlık kuruluşu tipine göre filtreleme
  - Derecelendirme ve mesafeye göre sıralama
  - Google Places API entegrasyonu
  - Gerçek zamanlı konum bazlı arama

- **👤 Kullanıcı Yönetimi**
  - JWT tabanlı kimlik doğrulama
  - E-posta ve telefon doğrulaması
  - Profil yönetimi ve fotoğraf yükleme
  - Şifre sıfırlama ve değiştirme
  - Oturum yönetimi ve güvenlik

- **⭐ Değerlendirme Sistemi**
  - Sağlık kuruluşlarını puanlama
  - Yorum ekleme/düzenleme/silme
  - En çok favoriye eklenen sağlık kuruluşlarını görüntüleme
  - Detaylı değerlendirme kriterleri
  - Fotoğraf ekleyebilme özelliği

- **📋 Kişiselleştirme**
  - Favori sağlık kuruluşları listesi
  - Sağlık kuruluşu karşılaştırma
  - Kişisel değerlendirme geçmişi
  - Özelleştirilmiş arama tercihleri
  - Bildirim tercihleri

## 🛠 Teknolojiler

- **Framework:** Laravel 10.x
- **Veritabanı:** MySQL
- **Kimlik Doğrulama:** JWT (JSON Web Token)
- **Harici Servisler:** 
  - Google Places API
  - Google Maps API
  - SMS API (Telefon Doğrulama)
  - SMTP (E-posta Bildirimleri)
- **Test:** PHPUnit
- **Dokümantasyon:** Scribe API Documentation
- **Cache:** Redis
- **Queue:** Laravel Queue (Redis/Database)

## 📋 Gereksinimler

- PHP >= 8.1
- Composer
- MySQL >= 8.0
- Redis >= 6.0 (İsteğe Bağlı)
- Google Places API Anahtarı
- SMTP Sunucu Bilgileri
- SMS API Bilgileri

## ⚙️ Kurulum

1. Projeyi klonlayın:
```bash
git clone https://github.com/your-username/SaglikPusulam-Backend.git
cd SaglikPusulam-Backend
```

2. Bağımlılıkları yükleyin:
```bash
composer install
```

3. `.env` dosyasını oluşturun:
```bash
cp .env.example .env
```

4. `.env` dosyasını düzenleyin:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=saglik_pusulam
DB_USERNAME=root
DB_PASSWORD=

GOOGLE_PLACES_API_KEY=your_api_key
GOOGLE_MAPS_API_KEY=your_api_key

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@saglikpusulam.com

SMS_API_KEY=your_sms_api_key
SMS_API_SECRET=your_sms_api_secret

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

5. Uygulama anahtarını oluşturun:
```bash
php artisan key:generate
```

6. JWT secret anahtarını oluşturun:
```bash
php artisan jwt:secret
```

7. Veritabanı tablolarını oluşturun:
```bash
php artisan migrate
```

8. Temel verileri yükleyin:
```bash
php artisan db:seed
```

9. Storage linkini oluşturun:
```bash
php artisan storage:link
```

10. Queue worker'ı başlatın (isteğe bağlı):
```bash
php artisan queue:work
```

11. Uygulamayı başlatın:
```bash
php artisan serve
```

## 🧪 Testler

Testleri çalıştırmak için:

```bash
php artisan test
```

Belirli bir test sınıfını çalıştırmak için:

```bash
php artisan test --filter HealthTest
```

## 📚 API Dokümantasyonu

API dokümantasyonunu oluşturmak için:

```bash
php artisan scribe:generate
```

Dokümantasyona `http://localhost:8000/docs` adresinden erişebilirsiniz.

## 🔑 API Endpoint'leri

### Kimlik Doğrulama
- `POST /api/v1/auth/register` - Kullanıcı kaydı
- `POST /api/v1/auth/login` - Giriş
- `POST /api/v1/auth/verify` - Kayıt doğrulama
- `POST /api/v1/auth/forgot-password` - Şifre sıfırlama isteği
- `POST /api/v1/auth/reset-password` - Şifre sıfırlama

### Sağlık Hizmetleri
- `POST /api/v1/health/search` - Sağlık hizmeti arama
- `POST /api/v1/health/filter` - Sonuçları filtreleme
- `GET /api/v1/health/most-favorited` - En çok favoriye alınanlar
- `GET /api/v1/health/details/search` - Detaylı arama
- `GET /api/v1/health/load-more` - Daha fazla sonuç yükleme

### Profil İşlemleri
- `PUT /api/v1/profile/update` - Profil güncelleme
- `POST /api/v1/profile/upload-photo` - Fotoğraf yükleme
- `POST /api/v1/profile/change-password` - Şifre değiştirme
- `GET /api/v1/profile/favorites` - Favorileri görüntüleme
- `POST /api/v1/profile/favorites/{placeId}` - Favorilere ekleme/çıkarma
- `GET /api/v1/profile/comparisons` - Karşılaştırma listesini görüntüleme
- `POST /api/v1/profile/comparisons/{placeId}` - Karşılaştırmaya ekleme/çıkarma
- `GET /api/v1/profile/check-lists/{placeId}` - Liste durumlarını kontrol etme

### Değerlendirmeler
- `GET /api/v1/health/details/{placeId}/reviews` - Değerlendirmeleri görüntüleme
- `POST /api/v1/health/details/{placeId}/add-review` - Değerlendirme ekleme
- `PUT /api/v1/health/details/{placeId}/update-review` - Değerlendirme güncelleme
- `DELETE /api/v1/health/details/{placeId}/delete-review` - Değerlendirme silme

### Google Places
- `GET /api/v1/places/search` - Google Places üzerinden arama
- `GET /api/v1/places/photo/{photoReference}` - Fotoğraf görüntüleme

## 🤝 Katkıda Bulunma

1. Bu repository'yi fork edin
2. Yeni bir branch oluşturun (`git checkout -b feature/amazing-feature`)
3. Değişikliklerinizi commit edin (`git commit -m 'feat: Add amazing feature'`)
4. Branch'inizi push edin (`git push origin feature/amazing-feature`)
5. Pull Request oluşturun

## 🐛 Hata Raporlama

Bir hata bulduysanız lütfen GitHub Issues üzerinden bildirin:

1. Hatanın detaylı açıklaması
2. Hatayı tetikleyen adımlar
3. Beklenen davranış
4. Gerçekleşen davranış
5. Varsa ekran görüntüleri
6. Ortam bilgileri (PHP sürümü, Laravel sürümü vb.)

## 📝 Lisans

Bu proje MIT lisansı altında lisanslanmıştır. Daha fazla bilgi için `LICENSE` dosyasına bakın.

## 📞 İletişim

Proje Sahibi - teams -> @yetenekistka

Proje Linki: [https://github.com/Yetenek-Istanbul-Projesi/SaglikPusulam-Backend](https://github.com/Yetenek-Istanbul-Projesi/SaglikPusulam-Backend)

## 🙏 Teşekkürler

- [Laravel](https://laravel.com)
- [Google Places API](https://developers.google.com/maps/documentation/places/web-service/overview)
- [JWT Auth](https://jwt.io)
- [PHPUnit](https://phpunit.de)
- [Scribe](https://scribe.knuckles.wtf)
- [Yetenek ISTKA]((https://yetenekistanbul.gedik.edu.tr/))
