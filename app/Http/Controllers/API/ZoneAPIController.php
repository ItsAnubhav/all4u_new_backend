<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Zones\CreateZoneRequest;
use App\Http\Requests\Zones\UpdateZoneRequest;
use App\Models\Zone;
use App\Repositories\ZoneRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ZoneAPIController
 */
class ZoneAPIController extends AppBaseController
{
    private ZoneRepository $zoneRepository;

    public function __construct(ZoneRepository $zoneRepo)
    {
        $this->zoneRepository = $zoneRepo;
    }

    /**
     * Display a listing of the Zones.
     * GET|HEAD /zones
     */
    public function index(Request $request): JsonResponse
    {
        $zones = $this->zoneRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($zones->toArray(), 'Zones retrieved successfully');
    }

    /**
     * Store a newly created Zone in storage.
     * POST /zones
     */
    public function store(CreateZoneRequest $request): JsonResponse
    {
        $input = $request->all();

        $zone = $this->zoneRepository->create($input);

        return $this->sendResponse($zone->toArray(), 'Zone saved successfully');
    }

    /**
     * Display the specified Zone.
     * GET|HEAD /zones/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Zone $zone */
        $zone = $this->zoneRepository->find($id);

        if (empty($zone)) {
            return $this->sendError('Zone not found');
        }

        return $this->sendResponse($zone->toArray(), 'Zone retrieved successfully');
    }

    /**
     * Update the specified Zone in storage.
     * PUT/PATCH /zones/{id}
     */
    public function update($id, UpdateZoneRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Zone $zone */
        $zone = $this->zoneRepository->find($id);

        if (empty($zone)) {
            return $this->sendError('Zone not found');
        }

        $zone = $this->zoneRepository->update($input, $id);

        return $this->sendResponse($zone->toArray(), 'Zone updated successfully');
    }

    /**
     * Remove the specified Zone from storage.
     * DELETE /zones/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Zone $zone */
        $zone = $this->zoneRepository->find($id);

        if (empty($zone)) {
            return $this->sendError('Zone not found');
        }

        $zone->delete();

        return $this->sendSuccess('Zone deleted successfully');
    }
}
