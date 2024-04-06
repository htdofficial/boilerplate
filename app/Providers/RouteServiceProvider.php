<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // public api route
            Route::prefix('api')->group(function(){

                request()->headers->set('Accept', 'application/json');
    
                Route::prefix('v1')->group(function(){
                    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
                    Route::post('forgot-password', [\App\Http\Controllers\Api\AuthController::class, 'forgotPassword']);
                    Route::post('reset-password', [\App\Http\Controllers\Api\AuthController::class, 'resetPassword']);

                    Route::middleware(['api','auth:api'])->group(function(){
                        Route::get('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->name('logout');
                        Route::get('profile', [\App\Http\Controllers\Api\AuthController::class, 'profile'])->name('profile');
                        
                        Route::middleware('is_allowed')->group(base_path('routes/api/v1.php'));
                    });
                });
                
            });


            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
