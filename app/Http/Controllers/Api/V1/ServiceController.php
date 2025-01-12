<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\Service\ServiceManagementService;
use App\Traits\HasBreadcrumbs;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    use HasBreadcrumbs;

    private ServiceManagementService $serviceManagement;

    public function __construct(ServiceManagementService $serviceManagement)
    {
        $this->serviceManagement = $serviceManagement;
    }

    // Tüm hizmetleri listele
    public function index(): JsonResponse
    {
        $services = $this->serviceManagement->listServices();
        
        return $this->addBreadcrumbs(
            $services->toArray(),
            'services'
        );
    }

    // Belirli bir hizmeti göster
    public function show(Service $service): JsonResponse
    {
        $service = $this->serviceManagement->getService($service->id);

        return $this->addBreadcrumbs(
            $service->toArray(),
            'services',
            $service->name
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
