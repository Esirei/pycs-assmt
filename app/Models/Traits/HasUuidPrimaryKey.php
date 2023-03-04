<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuidPrimaryKey
{
    protected static function bootHasUuidPrimaryKey(): void
    {
        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), (string) ($model->getKey() ?? Str::orderedUuid()));
        });
    }

    protected function initializeHasUuidPrimaryKey(): void
    {
        $this->setIncrementing(false)
            ->setKeyType('string')
            ->setKeyName('uuid');
    }
}
