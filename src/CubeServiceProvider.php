<?php

namespace QRFeedz\Cube;

use Illuminate\Support\ServiceProvider;
use QRFeedz\Cube\Commands\Test;
use QRFeedz\Cube\Models\Affiliate;
use QRFeedz\Cube\Models\Authorization;
use QRFeedz\Cube\Models\Category;
use QRFeedz\Cube\Models\Client;
use QRFeedz\Cube\Models\Country;
use QRFeedz\Cube\Models\Group;
use QRFeedz\Cube\Models\Locale;
use QRFeedz\Cube\Models\OpenAIPrompt;
use QRFeedz\Cube\Models\PageType;
use QRFeedz\Cube\Models\PageTypeQuestionnaire;
use QRFeedz\Cube\Models\Question;
use QRFeedz\Cube\Models\Questionnaire;
use QRFeedz\Cube\Models\QuestionWidgetTypeConditional;
use QRFeedz\Cube\Models\Response;
use QRFeedz\Cube\Models\Tag;
use QRFeedz\Cube\Models\User;
use QRFeedz\Cube\Models\WidgetType;
use QRFeedz\Cube\Observers\AffiliateObserver;
use QRFeedz\Cube\Observers\AuthorizationObserver;
use QRFeedz\Cube\Observers\CategoryObserver;
use QRFeedz\Cube\Observers\ClientObserver;
use QRFeedz\Cube\Observers\CountryObserver;
use QRFeedz\Cube\Observers\GroupObserver;
use QRFeedz\Cube\Observers\LocaleObserver;
use QRFeedz\Cube\Observers\OpenAIPromptObserver;
use QRFeedz\Cube\Observers\PageTypeObserver;
use QRFeedz\Cube\Observers\PageTypeQuestionnaireObserver;
use QRFeedz\Cube\Observers\QuestionnaireObserver;
use QRFeedz\Cube\Observers\QuestionObserver;
use QRFeedz\Cube\Observers\QuestionWidgetTypeConditionalObserver;
use QRFeedz\Cube\Observers\ResponseObserver;
use QRFeedz\Cube\Observers\TagObserver;
use QRFeedz\Cube\Observers\UserObserver;
use QRFeedz\Cube\Observers\WidgetTypeObserver;

class CubeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerObservers();

        $this->commands([
            Test::class,
        ]);
    }

    public function register()
    {
        //
    }

    protected function registerObservers(): void
    {
        Tag::observe(TagObserver::class);
        PageTypeQuestionnaire::observe(PageTypeQuestionnaireObserver::class);
        User::observe(UserObserver::class);
        Group::observe(GroupObserver::class);
        Client::observe(ClientObserver::class);
        WidgetType::observe(WidgetTypeObserver::class);
        Locale::observe(LocaleObserver::class);
        Country::observe(CountryObserver::class);
        PageType::observe(PageTypeObserver::class);
        Question::observe(QuestionObserver::class);
        Response::observe(ResponseObserver::class);
        Category::observe(CategoryObserver::class);
        Affiliate::observe(AffiliateObserver::class);
        OpenAIPrompt::observe(OpenAIPromptObserver::class);
        Authorization::observe(AuthorizationObserver::class);
        Questionnaire::observe(QuestionnaireObserver::class);
        QuestionWidgetTypeConditional::observe(QuestionWidgetTypeConditionalObserver::class);
    }
}
