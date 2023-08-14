<?php

namespace QRFeedz\Cube\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasAutoIncrementsByGroup
{
    /**
     * Increment by a specific group.
     *
     * @param string|array $groupColumn
     * @param string $incrementColumn
     * @param int $defaultValue
     * @return void
     */
    public function incrementByGroup(
        string|array $groupColumn,
        string $incrementColumn = 'index',
        int $defaultValue = 1
    ) {
        // If increment column already has a value, don't modify it.
        if ($this->$incrementColumn) {
            return;
        }

        // Initialize base query.
        $query = $this->newQueryWithPossibleTrashed();

        // Normalize group column to an array.
        if (!is_array($groupColumn)) {
            $groupColumns = (array) $groupColumn;
        }

        // Apply the grouping conditions.
        foreach ($groupColumns as $column) {
            $query->where($column, $this->$column);
        }

        $maxValue = $query->max($incrementColumn);

        return ($maxValue ?? 0) + $defaultValue;
    }

    /**
     * Create a new model query builder that includes trashed models if applicable.
     *
     * @return Builder
     */
    protected function newQueryWithPossibleTrashed(): Builder
    {
        $query = $this->newQuery();

        // Check if the model uses SoftDeletes trait by method existence.
        if (method_exists($this, 'withTrashed')) {
            $query->withTrashed();
        }

        return $query;
    }
}
