<?php

namespace Wexample\SymfonyMediaDemo\Traits;

use Wexample\SymfonyHelpers\Traits\BundleClassTrait;
use Wexample\SymfonyMediaDemo\WexampleSymfonyMediaDemoBundle;

trait SymfonyMediaDemoBundleClassTrait
{
    use BundleClassTrait;

    public static function getBundleClassName(): string
    {
        return WexampleSymfonyMediaDemoBundle::class;
    }
}
