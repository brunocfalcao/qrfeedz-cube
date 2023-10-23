<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\QuestionInstance;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class QuestionInstanceObserver extends QRFeedzObserver
{
    public function saving(QuestionInstance $model)
    {
        $this->validate($model, [
            'uuid' => 'required',
            'page_instance_id' => 'required',
            'is_analytical' => 'required',
            'is_used_for_personal_data' => 'required',
        ]);

        $model->index = $model->incrementByGroup('page_instance_id');
    }

    public function deleting(QuestionInstance $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model).' cannot be deleted');
        }
    }

    public function forceDeleting(QuestionInstance $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model).' is not soft deleted first');
        }
    }
}
