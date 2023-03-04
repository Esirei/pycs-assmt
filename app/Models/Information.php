<?php

namespace App\Models;

use App\Models\Enums\InformationType;
use App\Models\Traits\HasUuidPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Information extends Model
{
    use HasFactory;
    use HasUuidPrimaryKey;

    protected $fillable = [
        'type',
        'content',
    ];

    protected $casts = [
        'type' => InformationType::class,
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
