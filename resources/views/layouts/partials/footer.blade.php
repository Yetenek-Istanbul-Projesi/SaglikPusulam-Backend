<footer style="background-color:#3465FD;">
    <div class="container-fluid">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
            <div class="col mb-3">
                <a href="{{ url('/') }}" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none" style="color: white;">
                    <svg class="bi me-2" width="40" height="32">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>
                <div style="display: flex; align-items: center;">
                    <img src="{{ asset('assets/img/Footer_logo.svg') }}" alt="Logo" style="width: 60px; height: 55px; margin-right: 10px;">
                    <h6><a class="navbar-brand no-style" href="{{ url('/') }}" style="color: white !important;"><b>Sağlık</b>&nbsp;Pusulam</a></h6>
                </div>
            </div>

            <div class="col mb-3"></div>

            <div class="col mb-3">
                <h6 style="color: white;">KURUMSAL</h6>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ url('/about-us') }}" style="color: white; text-decoration: none;">Hakkımızda</a></li>
                    <li class="nav-item mb-2"><a href="{{ url('/sss') }}" style="color: white; text-decoration: none;">Sıkça Sorulan Sorular</a></li>
                    <li class="nav-item mb-2"><a href="{{ url('/contact') }}" style="color: white; text-decoration: none;">İletişim</a></li>
                    <li class="nav-item mb-2"><a href="{{ url('/blog') }}" style="color: white; text-decoration: none;">Blog</a></li>
                </ul>
            </div>

            <div class="col mb-3">
                <h6 style="color: white;">ZİYARETÇİ</h6>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ url('/account/login') }}" style="color: white; text-decoration: none;">Giriş Yap</a></li>
                    <li class="nav-item mb-2"><a href="{{ url('/account/register') }}" style="color: white; text-decoration: none;">Kaydol</a></li>
                    <li class="nav-item mb-2"><a href="{{ url('/account/forgot-password') }}" style="color: white; text-decoration: none;">Şifremi Unuttum</a></li>
                    <li class="nav-item mb-2"><a href="{{ url('/account/reset-password') }}" style="color: white; text-decoration: none;">Yeni Şifre Oluştur</a></li>
                </ul>
            </div>

            <div class="col mb-3">
                <h6 style="color: white; text-align: left;">BİZİMLE İLETİŞİME GEÇİNİZ</h6>
                <ul class="nav flex-column" style="text-align: left;">
                    <li class="nav-item mb-2">
                        <a href="#" style="color: white; text-decoration: none;">info@saglikpusulam.com</a>
                    </li>
                    <li class="nav-item mb-2" style="text-align: left;">
                        <h6 style="color: white; text-decoration: none; text-align: left;">BİZİ TAKİP EDİN</h6>
                        <div class="d-flex justify-content-start align-items-center gap-3">
                            <a href="https://www.linkedin.com/" class="hover-effect"><img src="{{ asset('assets/img/mdi_linkedin.png') }}" alt="linkedin" style="width: 30px; height: 30px;"></a>
                            <a href="https://x.com/" class="hover-effect"><img src="{{ asset('assets/img/mdi_twitter.png') }}" alt="twitter" style="width: 30px; height: 30px;"></a>
                            <a href="https://www.facebook.com/" class="hover-effect"><img src="{{ asset('assets/img/line-md_facebook.png') }}" alt="facebook" style="width: 30px; height: 30px;"></a>
                        </div>
                    </li>
                </ul>
            </div>

            <div style="width: 100%;">
                <p style="color: white;">İş bu sayfada yer alan yorumlar, ilgilİ doktorun doğrudan veya dolaylı emri, talebi ve/veya ricası olmaksızın, ilgili hasta tarafından bağımsız olarak yazılmaktadır. Bu web sitesinin temel amacı sağlık alanında kamuoyunun daha iyi bilgilenmesi sağlamaktır.</p>
                <hr>
                <div class="d-flex justify-content-start">
                    <a href="{{ url('/terms-of-use') }}" class="link-style fw-medium me-3" style="color: white;">Kullanım şartları</a>
                    <a href="{{ url('/kvkk') }}" class="link-style fw-medium" style="color: white;">KVKK</a>
                </div>
            </div>
        </footer>
    </div>
</footer>