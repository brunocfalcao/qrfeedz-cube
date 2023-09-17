<?php

namespace QRFeedz\Cube;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use QRFeedz\Cube\Gates\AuthorizationGates;
use QRFeedz\Cube\Gates\CategoryGates;
use QRFeedz\Cube\Gates\ClientGates;
use QRFeedz\Cube\Gates\CountryGates;
use QRFeedz\Cube\Gates\LocaleGates;
use QRFeedz\Cube\Gates\LocationGates;
use QRFeedz\Cube\Gates\OpenAIPromptGates;
use QRFeedz\Cube\Gates\PageGates;
use QRFeedz\Cube\Gates\PageInstanceGates;
use QRFeedz\Cube\Gates\QuestionInstanceGates;
use QRFeedz\Cube\Gates\QuestionnaireGates;
use QRFeedz\Cube\Gates\ResponseGates;
use QRFeedz\Cube\Gates\TagGates;
use QRFeedz\Cube\Gates\UserGates;
use QRFeedz\Cube\Gates\WidgetGates;
use QRFeedz\Cube\Gates\WidgetInstanceGates;
use QRFeedz\Cube\Models\Authorization;
use QRFeedz\Cube\Models\Category;
use QRFeedz\Cube\Models\Client;
use QRFeedz\Cube\Models\Country;
use QRFeedz\Cube\Models\Locale;
use QRFeedz\Cube\Models\Location;
use QRFeedz\Cube\Models\OpenAIPrompt;
use QRFeedz\Cube\Models\Page;
use QRFeedz\Cube\Models\PageInstance;
use QRFeedz\Cube\Models\QuestionInstance;
use QRFeedz\Cube\Models\Questionnaire;
use QRFeedz\Cube\Models\Response;
use QRFeedz\Cube\Models\Tag;
use QRFeedz\Cube\Models\User;
use QRFeedz\Cube\Models\Widget;
use QRFeedz\Cube\Models\WidgetInstance;
use QRFeedz\Cube\Observers\AuthorizationObserver;
use QRFeedz\Cube\Observers\CategoryObserver;
use QRFeedz\Cube\Observers\ClientObserver;
use QRFeedz\Cube\Observers\CountryObserver;
use QRFeedz\Cube\Observers\LocaleObserver;
use QRFeedz\Cube\Observers\LocationObserver;
use QRFeedz\Cube\Observers\OpenAIPromptObserver;
use QRFeedz\Cube\Observers\PageInstanceObserver;
use QRFeedz\Cube\Observers\PageObserver;
use QRFeedz\Cube\Observers\QuestionInstanceObserver;
use QRFeedz\Cube\Observers\QuestionnaireObserver;
use QRFeedz\Cube\Observers\ResponseObserver;
use QRFeedz\Cube\Observers\TagObserver;
use QRFeedz\Cube\Observers\UserObserver;
use QRFeedz\Cube\Observers\WidgetInstanceObserver;
use QRFeedz\Cube\Observers\WidgetObserver;
use QRFeedz\Services\Facades\QRFeedz;

class CubeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerObservers();

        if (! app()->runningInConsole()) {
            $this->registerGates();
            $this->registerPolicies();
            $this->registerGlobalScopes();
        }
    }

    public function register()
    {
        //
    }

    protected function registerGates()
    {
        TagGates::apply();
        UserGates::apply();
        PageGates::apply();
        WidgetGates::apply();
        LocaleGates::apply();
        ClientGates::apply();
        WidgetGates::apply();
        CountryGates::apply();
        ResponseGates::apply();
        CategoryGates::apply();
        LocationGates::apply();
        PageInstanceGates::apply();
        OpenAIPromptGates::apply();
        AuthorizationGates::apply();
        QuestionnaireGates::apply();
        WidgetInstanceGates::apply();
        QuestionInstanceGates::apply();
    }

    protected function registerPolicies()
    {
        $modelPaths = glob(__DIR__.'/Models/*.php');
        $modelClasses = array_map(function ($path) {
            return basename($path, '.php');
        }, $modelPaths);

        $prefix = null;

        switch (QRFeedz::context()) {
            case 'frontend':
                $prefix = 'Frontend';
                break;
            case 'admin':
            case 'backend':  // Both admin and backend use 'Admin'.
                $prefix = 'Admin';
                break;
        }

        if ($prefix) {
            foreach ($modelClasses as $model) {
                $modelClass = "\\QRFeedz\\Cube\\Models\\{$model}";
                $policyClass = "\\QRFeedz\\Cube\\Policies\\{$prefix}\\{$model}Policy";

                if (class_exists($modelClass) && class_exists($policyClass)) {
                    info("attribuing policy {$policyClass} to model {$modelClass}");
                    Gate::policy($modelClass, $policyClass);
                }
            }
        }
    }

    protected function registerGlobalScopes()
    {
        $modelPaths = glob(__DIR__.'/Models/*.php');
        $modelClasses = array_map(function ($path) {
            return basename($path, '.php');
        }, $modelPaths);

        $prefix = null;

        switch (QRFeedz::context()) {
            case 'frontend':
                $prefix = 'Frontend';
                break;
            case 'admin':
            case 'backend':
                $prefix = 'Admin';
                break;
        }

        if ($prefix) {
            foreach ($modelClasses as $model) {
                $modelClass = "\\QRFeedz\\Cube\\Models\\{$model}";
                $scopeClass = "\\QRFeedz\\Cube\\Scopes\\{$prefix}\\{$model}Scope";

                if (class_exists($modelClass) && class_exists($scopeClass)) {
                    info("attribuing global scope {$scopeClass} to model {$modelClass}");
                    $modelClass::addGlobalScope(new $scopeClass);
                }
            }
        }
    }

    protected function registerObservers()
    {
        Tag::observe(TagObserver::class);
        Page::observe(PageObserver::class);
        User::observe(UserObserver::class);
        Client::observe(ClientObserver::class);
        Widget::observe(WidgetObserver::class);
        Locale::observe(LocaleObserver::class);
        Location::observe(LocationObserver::class);
        Country::observe(CountryObserver::class);
        Response::observe(ResponseObserver::class);
        Category::observe(CategoryObserver::class);
        PageInstance::observe(PageInstanceObserver::class);
        OpenAIPrompt::observe(OpenAIPromptObserver::class);
        Authorization::observe(AuthorizationObserver::class);
        Questionnaire::observe(QuestionnaireObserver::class);
        WidgetInstance::observe(WidgetInstanceObserver::class);
        QuestionInstance::observe(QuestionInstanceObserver::class);
    }
}
