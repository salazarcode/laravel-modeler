<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StringValue extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'StringValues';
    protected $primaryKey = null; // Clave primaria compuesta
    public $incrementing = false; // No auto-incremental

    protected $fillable = [
        'EntityId',
        'PropertyId',
        'Value',
        'Sequence',
    ];

    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class, 'EntityId', 'EntityId');
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'PropertyId', 'PropertyId');
    }
}
