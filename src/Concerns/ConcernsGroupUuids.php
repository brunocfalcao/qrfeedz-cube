<?php

namespace QRFeedz\Cube\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * This is a specific trait that optimizes my code on model observers that
 * have a group_uuid and a version column. The version will increment
 * if the group_uuid is the same, and if there is no group_uuid and/or
 * version, it will autogenerate it.
 */
trait ConcernsGroupUuids
{
    public function resolveGroupedUuid(Model $model, string $groupUuid = 'group_uuid', string $version = 'version')
    {
        if (! $model->$groupUuid) {
            $model->$groupUuid = (string) Str::uuid();
        }

        if (! $model->$version) {
            $model->$version = 1;
        }

        $lastVersion = (new $model())::withTrashed()
                              ->where($groupUuid, $model->$groupUuid)
                              ->where('id', '<>', $model->id)
                              ->orderBy($version, 'desc')
                              ->first();

        if ($lastVersion) {
            $model->$version = $lastVersion->$version + 1;
        }
    }
}
