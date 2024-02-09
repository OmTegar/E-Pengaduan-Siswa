<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

use function Pest\Laravel\get;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Model::preventLazyLoading(!$this->app->isProduction());
        Model::preventLazyLoading(true);
        // Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
        //     $class = get_class($model);

        //     info("Attemppt Lazy load to: {$class}::{$relation}.");
        // });
    }
}
