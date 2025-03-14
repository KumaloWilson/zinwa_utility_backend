<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\Meter;
use App\Models\Token;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminService
{
    /**
     * Get dashboard statistics
     */
    public function getDashboardStats(): array
    {
        $totalUsers = User::count();
        $totalMeters = Meter::count();
        $totalTokens = Token::count();

        $totalRevenue = Transaction::where('status', 'completed')
            ->sum('amount');

        $recentTransactions = Transaction::with(['user', 'meter'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $usersByRole = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->get();

        $transactionsByDay = Transaction::where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(30))
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('sum(amount) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'total_users' => $totalUsers,
            'total_meters' => $totalMeters,
            'total_tokens' => $totalTokens,
            'total_revenue' => $totalRevenue,
            'recent_transactions' => $recentTransactions,
            'users_by_role' => $usersByRole,
            'transactions_by_day' => $transactionsByDay,
        ];
    }

    /**
     * Get all users with filtering
     */
    public function getUsers(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = User::query();

        // Apply filters
        if (isset($filters['role'])) {
            $query->where('role', $filters['role']);
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate(15);
    }

    /**
     * Update user status
     */
    public function updateUserStatus(User $user, $status): User
    {
        $user->status = $status;
        $user->save();

        // Log the action
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_user_status',
            'model_type' => User::class,
            'model_id' => $user->id,
            'old_values' => ['status' => $user->getOriginal('status')],
            'new_values' => ['status' => $status],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return $user;
    }

    /**
     * Get all meters with filtering
     */
    public function getMeters(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = Meter::with('user');

        // Apply filters
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['meter_type'])) {
            $query->where('meter_type', $filters['meter_type']);
        }

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('meter_number', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate(15);
    }

    /**
     * Update meter status
     */
    public function updateMeterStatus(Meter $meter, $status): Meter
    {
        $meter->status = $status;
        $meter->save();

        // Log the action
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_meter_status',
            'model_type' => Meter::class,
            'model_id' => $meter->id,
            'old_values' => ['status' => $meter->getOriginal('status')],
            'new_values' => ['status' => $status],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return $meter;
    }

    /**
     * Get all transactions with filtering
     */
    public function getTransactions(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = Transaction::with(['user', 'meter']);

        // Apply filters
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['payment_method'])) {
            $query->where('payment_method', $filters['payment_method']);
        }

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('reference', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('meter', function ($meterQuery) use ($search) {
                        $meterQuery->where('meter_number', 'like', "%{$search}%");
                    });
            });
        }

        if (isset($filters['date_from'])) {
            $query->where('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to'])) {
            $query->where('created_at', '<=', $filters['date_to']);
        }

        return $query->orderBy('created_at', 'desc')->paginate(15);
    }

    /**
     * Get all tokens with filtering
     */
    public function getTokens(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = Token::with(['user', 'meter', 'transaction']);

        // Apply filters
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('token_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('meter', function ($meterQuery) use ($search) {
                        $meterQuery->where('meter_number', 'like', "%{$search}%");
                    });
            });
        }

        if (isset($filters['date_from'])) {
            $query->where('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to'])) {
            $query->where('created_at', '<=', $filters['date_to']);
        }

        return $query->orderBy('created_at', 'desc')->paginate(15);
    }

    /**
     * Get audit logs with filtering
     */
    public function getAuditLogs(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = AuditLog::with('user');

        // Apply filters
        if (isset($filters['action'])) {
            $query->where('action', $filters['action']);
        }

        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('action', 'like', "%{$search}%")
                    ->orWhere('model_type', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if (isset($filters['date_from'])) {
            $query->where('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to'])) {
            $query->where('created_at', '<=', $filters['date_to']);
        }

        return $query->orderBy('created_at', 'desc')->paginate(15);
    }
}

