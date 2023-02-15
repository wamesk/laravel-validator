<?php

namespace Wame\Validator;

use Illuminate\Support\ServiceProvider;
use Wame\Validator\Utils\Helpers;

class LaravelValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Helpers::copyDir(__DIR__ . '/../resources/lang/', resource_path('lang'));

        $this->loadJSONTranslationsFrom(resource_path('lang'));
    }
}