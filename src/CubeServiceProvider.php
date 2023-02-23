<?php

namespace QRFeedz\Cube;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use QRFeedz\Cube\Models\Category;
use QRFeedz\Cube\Models\Country;
use QRFeedz\Cube\Models\Organization;
use QRFeedz\Cube\Models\Place;
use QRFeedz\Cube\Models\Questionnaire;
use QRFeedz\Cube\Models\Tag;
use QRFeedz\Cube\Models\User;
use QRFeedz\Cube\Observers\CategoryObserver;
use QRFeedz\Cube\Observers\CountryObserver;
use QRFeedz\Cube\Observers\OrganizationObserver;
use QRFeedz\Cube\Observers\PlaceObserver;
use QRFeedz\Cube\Observers\QuestionnaireObserver;
use QRFeedz\Cube\Observers\TagObserver;
use QRFeedz\Cube\Observers\UserObserver;
use QRFeedz\Cube\Policies\CategoryPolicy;
use QRFeedz\Cube\Policies\CountryPolicy;
use QRFeedz\Cube\Policies\PlacePolicy;
use QRFeedz\Cube\Policies\QuestionnairePolicy;
use QRFeedz\Cube\Policies\TagPolicy;
use QRFeedz\Cube\Policies\UserPolicy;

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
        Tag::observe(TagObserver::class);
        User::observe(UserObserver::class);
        Place::observe(PlaceObserver::class);
        Country::observe(CountryObserver::class);
        Category::observe(CategoryObserver::class);
        Organization::observe(OrganizationObserver::class);
        Questionnaire::observe(QuestionnaireObserver::class);
    }

    protected function registerPolicies(): void
    {
        Tag::policy(Tag::class, TagPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Place::class, PlacePolicy::class);
        Gate::policy(Country::class, CountryPolicy::class);
        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(Organization::class, OrganizationPolicy::class);
        Questionnaire::policy(Questionnaire::class, QuestionnairePolicy::class);
    }
}
