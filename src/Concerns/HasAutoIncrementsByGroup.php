<?php

namespace QRFeedz\Cube\Concerns;

use Illuminate\Support\Collection;

/**
 * This is a generic trait that checks a column value, and adds the maximum
 * group value given a group column value.
 */
trait HasAutoIncrementsByGroup
{
    public function incrementByGroup(
        string|array $groupColumn,
        string $incrementColumn = 'index',
        int $defaultValue = 1
    ) {
        if (! $this->$incrementColumn) {
            $query = (new self())::withTrashed();

            $groupColumn = is_string($groupColumn) ? [$groupColumn] : $groupColumn;

            $query = Collection::make($groupColumn)->reduce(function ($query, $column) {
                return $query->where($column, $this->$column);
            }, $query);

            $this->$incrementColumn = $query->max($incrementColumn) + 1;
        }
    }
}
