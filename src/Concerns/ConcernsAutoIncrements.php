<?php

namespace QRFeedz\Cube\Concerns;

use Illuminate\Database\Eloquent\Model;

/**
 * This is a generic trait that checks a column value, and adds the maximum
 * group value given a group column value.
 */
trait ConcernsAutoIncrements
{
    function resolveIncrement(
        Model $model,
        string $groupColumn,
        string $incrementColumn = 'index',
        int $defaultValue = 1
    ) {
        if (!$model->$incrementColumn) {
            $model->$incrementColumn = (new $model())::withTrashed()
                                            ->where($groupColumn, $model->$groupColumn)
                                            ->max($incrementColumn) + 1;
        }
    }
}
