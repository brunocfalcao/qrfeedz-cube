<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Cube\Concerns\HasAutoIncrementsByGroup;
use QRFeedz\Cube\Models\Pivots\PageTypeQuestionnaire;

class QuestionInstance extends Model
{
    use HasAutoIncrementsByGroup;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_required' => 'boolean',
        'is_analytical' => 'boolean',
        'is_single_value' => 'boolean',
        'is_used_for_personal_data' => 'boolean',
    ];

    /**
     * The related responses answered by visitors, part of the question instance.
     *
     * Source: responses.id
     * Relationship: validated
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    /**
     * In what page instances is this question instance being used. A page
     * instance is a special model PageInstance that is part of the
     * page_instances N-N table. While the page - questionnaire
     * relationship shows what page types are used in a
     * questionnaire, the pageInstance is needed to
     * use certain relationships that are not
     * possible to get from the N-N
     * relationship between the
     * page and the
     * questionnaire.
     *
     * Source: page_instances.id
     * Relationship: validated
     */
    public function pagesInstance()
    {
        return $this->belongsTo(PageInstance::class);
    }

    /**
     * What exactly widget instances are related with this question instance.
     * This is different from the widgets
     * @return [type] [description]
     */
    public function widgetInstances()
    {
        return $this->hasMany(WidgetInstance::class);
    }

    /**
     * A question instance itself has a caption, so this caption can be
     * translated in several languages. Therefore we have these
     * captions that will return all the caption locales that
     * were created.
     *
     * Source: locales.id
     * Relationship: validated
     */
    public function captions()
    {
        return $this->morphToMany(Locale::class, 'model')
                    ->with(['caption', 'placeholder'])
                    ->withTimestamps();
    }
}
