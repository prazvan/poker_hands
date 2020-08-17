<?php

namespace App\Http;

use App\Http\Middleware\{Authenticate,
    CheckForMaintenanceMode,
    EncryptCookies,
    HttpsProtocolMiddleware,
    RedirectIfAuthenticated,
    TrimStrings,
    TrustProxies,
    VerifyCsrfToken
};

use Fruitcake\Cors\HandleCors;

use Illuminate\Auth\Middleware\{
    AuthenticateWithBasicAuth,
    Authorize,
    EnsureEmailIsVerified,
    RequirePassword,

};

use Illuminate\Foundation\Http\{
    Kernel as HttpKernel,
    Middleware\ConvertEmptyStringsToNull,
    Middleware\ValidatePostSize
};

use Illuminate\Routing\Middleware\{
    SubstituteBindings,
    ThrottleRequests,
    ValidateSignature
};

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

/**
 * Class Kernel
 * @package App\Http
 */
class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        TrustProxies::class,
        HandleCors::class,
        CheckForMaintenanceMode::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
//        HttpsProtocolMiddleware::class
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'bindings' => SubstituteBindings::class,
        'cache.headers' => SetCacheHeaders::class,
        'can' => Authorize::class,
        'guest' => RedirectIfAuthenticated::class,
        'password.confirm' => RequirePassword::class,
        'signed' => ValidateSignature::class,
        'throttle' => ThrottleRequests::class,
        'verified' => EnsureEmailIsVerified::class,
    ];
}
