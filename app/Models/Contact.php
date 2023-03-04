<?php

namespace App\Models;

use App\Models\Traits\HasUuidPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;
    use HasUuidPrimaryKey;

    protected $fillable = [
        'name',
        'last_name',
        'company',
        'photo',
        'location',
    ];

    protected static function booted()
    {
        parent::booted();
        static::creating(function (Contact $contact) {
            $contact->uuid = (string)Str::orderedUuid();
        });
    }

    public function information(): HasMany
    {
        return $this->hasMany(Information::class);
    }
}
