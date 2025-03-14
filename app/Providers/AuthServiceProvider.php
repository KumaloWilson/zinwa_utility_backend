<?php

namespace App\Providers;

use App\Models\Meter;
use App\Models\Token;
use App\Models\UserNotification;
use App\Policies\MeterPolicy;
use App\Policies\TokenPolicy;
use App\Policies\UserNotificationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Meter::class => MeterPolicy::class,
        Token::class => TokenPolicy::class,
        UserNotification::class => UserNotificationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}

