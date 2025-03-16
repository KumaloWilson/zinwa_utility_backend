<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meter\RegisterMeterRequest;
use App\Http\Resources\ConsumptionRecordResource;
use App\Http\Resources\MeterResource;
use App\Models\Meter;
use App\Services\MeterService;
use Illuminate\Http\Request;

class MeterController extends Controller
{
    protected MeterService $meterService;

    public function __construct(MeterService $meterService)
    {
        $this->meterService = $meterService;
    }

    /**
     * Get all meters for authenticated user
     */
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $meters = $this->meterService->getUserMeters($request->user());

        return MeterResource::collection($meters);
    }

    /**
     * Register a new meter
     */
    public function store(RegisterMeterRequest $request): \Illuminate\Http\JsonResponse
    {
        $meter = $this->meterService->registerMeter($request->user(), $request->validated());

        return response()->json([
            'message' => 'Meter registered successfully',
            'meter' => new MeterResource($meter)
        ], 201);
    }

    /**
     * Get meter details
     */
    public function show(Request $request, Meter $meter): MeterResource
    {
        $this->authorize('view', $meter);

        return new MeterResource($meter);
    }

    /**
     * Update meter details
     */
    public function update(Request $request, Meter $meter): \Illuminate\Http\JsonResponse
    {
        $this->authorize('update', $meter);

        $request->validate([
            'location' => 'sometimes|string|max:255',
            'notes' => 'sometimes|string',
        ]);

        $meter = $this->meterService->updateMeter($meter, $request->only(['location', 'notes']));

        return response()->json([
            'message' => 'Meter updated successfully',
            'meter' => new MeterResource($meter)
        ]);
    }

    /**
     * Validate meter with utility provider
     */
    public function validate(Request $request, Meter $meter): \Illuminate\Http\JsonResponse
    {
        $this->authorize('update', $meter);

        $result = $this->meterService->validateMeter($meter);

        if ($result) {
            return response()->json([
                'message' => 'Meter validated successfully',
                'meter' => new MeterResource($meter->fresh())
            ]);
        }

        return response()->json([
            'message' => 'Failed to validate meter'
        ], 400);
    }

    /**
     * Get consumption history for a meter
     */
    public function consumptionHistory(Request $request, Meter $meter): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $this->authorize('view', $meter);

        $history = $this->meterService->getConsumptionHistory($meter);

        return ConsumptionRecordResource::collection($history);
    }
}

