<?php

use App\Models\Service;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Ana Sayfa
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Ana Sayfa', route('home'));
});

// Ana Sayfa > Hizmetler
Breadcrumbs::for('services', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Hizmetler', route('services.index'));
});

// Ana Sayfa > Hizmetler > [Hizmet Adı]
Breadcrumbs::for('service', function (BreadcrumbTrail $trail, Service $service) {
    $trail->parent('services');
    $trail->push($service->name, route('services.show', $service));
});

// Ana Sayfa > Hizmetler > [Hizmet Adı] > Yorumlar
Breadcrumbs::for('service.comments', function (BreadcrumbTrail $trail, Service $service) {
    $trail->parent('service', $service);
    $trail->push('Yorumlar', route('services.comments', $service));
});

// Ana Sayfa > Favoriler
Breadcrumbs::for('favorites', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Favorilerim', route('favorites.index'));
});

// Ana Sayfa > Karşılaştırma Listesi
Breadcrumbs::for('comparisons', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Karşılaştırma Listesi', route('comparisons.index'));
});

// Ana Sayfa > Profil
Breadcrumbs::for('profile', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Profilim', route('profile.index'));
});

// Ana Sayfa > Profil > Düzenle
Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('profile');
    $trail->push('Profili Düzenle', route('profile.edit'));
});
