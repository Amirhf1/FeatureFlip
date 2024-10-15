<?php

namespace amirhf1\FeatureToggle;

use Illuminate\Support\Facades\DB;

class FeatureToggle
{
    /**
     * Check if a feature is enabled.
     *
     * @param string $feature
     * @return bool
     */
    public function isEnabled(string $feature): bool
    {
        return DB::table('features')->where('name', $feature)->value('enabled') ?? false;
    }

    /**
     * Enable a feature.
     *
     * @param string $feature
     * @return void
     */
    public function enable(string $feature): void
    {
        DB::table('features')->updateOrInsert(
            ['name' => $feature],
            ['enabled' => true, 'updated_at' => now()]
        );
    }

    /**
     * Disable a feature.
     *
     * @param string $feature
     * @return void
     */
    public function disable(string $feature): void
    {
        DB::table('features')->updateOrInsert(
            ['name' => $feature],
            ['enabled' => false, 'updated_at' => now()]
        );
    }

    /**
     * Get all features.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return DB::table('features')->get();
    }
}
