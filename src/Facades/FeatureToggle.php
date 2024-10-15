<?php

namespace amirhf\FeatureToggle\Facades;

use Illuminate\Support\Facades\Facade;

class FeatureToggle extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'feature-toggle';
    }
}
