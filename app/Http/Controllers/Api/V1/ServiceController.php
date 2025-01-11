<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Traits\HasBreadcrumbs;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    use HasBreadcrumbs;

    // Tüm hizmetleri listele
    public function index(): JsonResponse
    {
        $services = Service::paginate(10);
        
        return $this->addBreadcrumbs(
            $services->toArray(),
            'services'
        );
    }

    // Belirli bir hizmeti göster
    public function show(Service $service): JsonResponse
    {
        return $this->addBreadcrumbs(
            $service->toArray(),
            'service',
            [$service]
        );
    }

    // Hizmetin yorumlarını göster
    public function comments(Service $service): JsonResponse
    {
        $comments = $service->comments()
            ->where('status', 'approved')
            ->with('user:id,first_name,last_name')
            ->paginate(10);

        return $this->addBreadcrumbs(
            $comments->toArray(),
            'service.comments',
            [$service]
        );
    }
}
