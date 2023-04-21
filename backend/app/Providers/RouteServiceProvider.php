<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = "/home";

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            $routeConfig = Route::middleware("api")
                ->prefix("api/v1")
                ->group(base_path("routes/api.php"));

            # Route::middleware("web")->group(base_path("routes/web.php"));
            $this->load_use_case_routes($routeConfig);
        });
    }

    private function load_use_case_routes($routeConfig)
    {
        $use_case_base_path = base_path("src/UseCase");
        $listUseCase = array_map("basename", File::directories($use_case_base_path));
        foreach ($listUseCase as $useCase) {
            $routePath = $use_case_base_path . "/" . $useCase . "/Router.php";
            if (file_exists($routePath)) {
                $routeConfig->group(base_path(ltrim($routePath, "/code/")));
            }
        }
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for("api", function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
