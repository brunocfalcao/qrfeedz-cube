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
            try {
                $model = (new self())::withTrashed();
            } catch (\Exception $e) {
                $model = (new self());
            }

            $groupColumn = is_string($groupColumn) ? [$groupColumn] : $groupColumn;

            $model = Collection::make($groupColumn)->reduce(function ($model, $column) {
                return $model->where($column, $this->$column);
            }, $model);

            $this->$incrementColumn = $model->max($incrementColumn) + 1;
        }
    }
}
