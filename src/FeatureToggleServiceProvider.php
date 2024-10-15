<?php

namespace amirhf1\FeatureToggle;

use Illuminate\Support\ServiceProvider;

class FeatureToggleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Publish the configuration file
        $this->publishes(
            [
                __DIR__ . '/../config/feature-toggle.php' => config_path('feature-toggle.php'),
            ], 'config');

        // Publish the migration
        if (!class_exists('CreateFeaturesTable')) {
            $this->publishes(
                [
                    __DIR__ . '/../database/migrations/create_features_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_features_table.php'),
                ], 'migrations');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Merge the configuration
        $this->mergeConfigFrom(
            __DIR__ . '/../config/feature-toggle.php',
            'feature-toggle'
        );

        // Bind the FeatureToggle class to the service container
        $this->app->singleton('feature-toggle', function ($app) {
            return new FeatureToggle($app['config']->get('feature-toggle'));
        });
    }
}
