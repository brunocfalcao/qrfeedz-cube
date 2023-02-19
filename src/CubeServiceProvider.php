<?php

namespace QRFeedz\Cube;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use QRFeedz\Cube\Models\Country;
use QRFeedz\Cube\Observers\CountryObserver;
use QRFeedz\Cube\Policies\CountryPolicy;

class CubeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerObservers();
        $this->registerPolicies();
    }

    public function register()
    {
        //
    }

    protected function registerObservers(): void
    {
        Country::observe(CountryObserver::class);
    }

    protected function registerPolicies(): void
    {
        Gate::policy(Country::class, CountryPolicy::class);
    }
}
