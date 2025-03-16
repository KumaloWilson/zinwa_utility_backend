<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Meter;
use App\Models\Meter;
use App\Models\Transaction;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
        $this->middleware('role:admin');
    }

    /**
     * Get dashboard statistics
     */
    public function dashboard()
    {
        $stats = $this->adminService->getDashboardStats();

        return response()->json($stats);
    }

    /**
     * Get all users
     */
    public function users(Request $request)
    {
        $users = $this->adminService->getUsers($request->all());

        return UserResource::collection($users);
    }

    /**
     * Update user status
     */
    public function updateUserStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $user = $this->adminService->updateUserStatus($user, $request->status);

        return response()->json([
            'message' => 'User status updated successfully',
            'user' => new UserResource($user)
        ]);
    }

    /**
     * Get all meters
     */
    public function meters(Request $request)
    {
        $meters = $this->adminService->getMeters($request->all());

        return response()->json([
            'meters' => $meters
        ]);
    }

    /**
     * Update meter status
     */
    public function updateMeterStatus(Request $request, Meter $meter)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,blocked',
        ]);

        $meter = $this->adminService->updateMeterStatus($meter, $request->status);

        return response()->json([
            'message' => 'Meter status updated successfully',
            'meter' => $meter
        ]);
    }

    /**
     * Get all transactions
     */
    public function transactions(Request $request)
    {
        $transactions = $this->adminService->getTransactions($request->all());

        return response()->json([
            'transactions' => $transactions
        ]);
    }

    /**
     * Get all tokens
     */
    public function tokens(Request $request)
    {
        $tokens = $this->adminService->getTokens($request->all());

        return response()->json([
            'tokens' => $tokens
        ]);
    }

    /**
     * Get audit logs
     */
    public function auditLogs(Request $request)
    {
        $logs = $this->adminService->getAuditLogs($request->all());

        return response()->json([
            'logs' => $logs
        ]);
    }
}

