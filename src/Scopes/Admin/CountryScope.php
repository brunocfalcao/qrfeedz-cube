<?php

namespace QRFeedz\Cube\Scopes\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CountryScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $table = $model->getTable();
        $keyName = $model->getKeyName();
        $builder->where("{$table}.{$keyName}", '<', 12);
    }
}
