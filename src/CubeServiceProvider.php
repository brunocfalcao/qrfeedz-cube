<?php

namespace QRFeedz\Cube;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use QRFeedz\Cube\Commands\TestCommand;
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

        $this->registerCommands();
    }

    public function register()
    {
        //
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                TestCommand::class,
            ]);
        }
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

                try {
                    if (class_exists($modelClass) && class_exists($policyClass)) {
                        $modelClassObject = new $modelClass;
                        $policyClassObject = new $policyClass;

                        Gate::policy(get_class($modelClassObject), get_class($policyClassObject));
                    }
                } catch (\Exception $ex) {
                    info('Policy Registration Error: '.$ex->getMessage());
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

                try {
                    if (class_exists($modelClass) && class_exists($scopeClass)) {
                        $modelClass::addGlobalScope(new $scopeClass);
                    }
                } catch (\Exception $ex) {
                }
            }
        }
    }

    protected function registerObservers()
    {
        $modelPaths = glob(__DIR__.'/Models/*.php');
        $modelClasses = array_map(function ($path) {
            return basename($path, '.php');
        }, $modelPaths);

        foreach ($modelClasses as $model) {
            $modelClass = "\\QRFeedz\\Cube\\Models\\{$model}";
            $observerClass = "\\QRFeedz\\Cube\\Observers\\{$model}Observer";

            try {
                if (class_exists($modelClass) && class_exists($observerClass)) {
                    $modelClass::observe($observerClass);
                }
            } catch (\Exception $ex) {
                info('Observer Registration Error: '.$ex->getMessage());
            }
        }
    }
}
