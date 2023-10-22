<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Locale;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class LocaleObserver extends QRFeedzObserver
{
    public function creating(Locale $model)
    {
        $this->validate($model, [
            'canonical' => 'required|unique:locales',
            'name' => 'required',
        ]);
    }

    public function updating(Locale $model)
    {
        $this->validate($model, [
            'name' => 'required',
            'canonical' => 'unique:locales,canonical,'.$model->id,
        ]);
    }

    public function deleting(Locale $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception('Authorization model cannot be deleted');
        }
    }

    public function forceDeleting(Locale $model)
    {
        if (! $model->trashed()) {
            throw new \Exception('Authorization model is not soft deleted first');
        }
    }
}
