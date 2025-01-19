<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\Google\HealthSearchCriteriaDTO;
use App\DTOs\Health\HealthFilterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\HealthSearchRequest;
use App\Http\Requests\HealthFilterRequest;
use App\Services\HealthSearchService;
use App\Http\Resources\HealthSearchResource;

class HealthSearchController extends Controller
{
    public function __construct(
        private readonly HealthSearchService $healthSearchService
    ) {}

    public function search(HealthSearchRequest $request)
    {
        $criteriaDTO = new HealthSearchCriteriaDTO(
            province: $request->province,
            district: $request->district,
            facilityType: $request->facility_type,
            specialization: $request->specialization
        );

        $results = $this->healthSearchService->searchResults($criteriaDTO);
        
        return new HealthSearchResource($results);
    }

    public function filter(HealthFilterRequest $request)
    {
        $filterDTO = HealthFilterDTO::fromRequest($request);
        $results = $this->healthSearchService->filterResults($filterDTO);
        
        return new HealthSearchResource($results);
    }

    public function loadMore()
    {
        $results = $this->healthSearchService->getNextPage();
        return new HealthSearchResource($results);
    }
}
