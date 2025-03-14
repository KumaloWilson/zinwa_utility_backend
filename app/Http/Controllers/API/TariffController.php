<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TariffResource;
use App\Services\TariffService;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    protected $tariffService;

    public function __construct(TariffService $tariffService)
    {
        $this->tariffService = $tariffService;
    }

    /**
     * Get all active tariffs
     */
    public function index()
    {
        $tariffs = $this->tariffService->getActiveTariffs();
        
        return TariffResource::collection($tariffs);
    }

    /**
     * Calculate price for units
     */
    public function calculate(Request $request)
    {
        $request->validate([
            'units' => 'required|numeric|min:1',
        ]);
        
        $result = $this->tariffService->calculatePrice($request->units);
        
        return response()->json([
            'units' => $request->units,
            'base_amount' => $result['base_amount'],
            'tax_amount' => $result['tax_amount'],
            'service_fee' => $result['service_fee'],
            'total_amount' => $result['total_amount'],
            'tariff' => new TariffResource($result['tariff']),
        ]);
    }
}

