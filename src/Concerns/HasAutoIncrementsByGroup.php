<?php

namespace QRFeedz\Cube\Concerns;

use Illuminate\Database\Eloquent\Model;

/**
 * This is a generic trait that checks a column value, and adds the maximum
 * group value given a group column value.
 */
trait HasAutoIncrementsByGroup
{
    public function incrementByGroup(
        string $groupColumn,
        string $incrementColumn = 'index',
        int $defaultValue = 1
    ) {
        if (! $this->$incrementColumn) {
            $this->$incrementColumn = (new self())::withTrashed()
                                            ->where($groupColumn, $this->$groupColumn)
                                            ->max($incrementColumn) + 1;
        }
    }
}
