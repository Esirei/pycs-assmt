<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
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
}
