<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entity extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'Entities';
    protected $primaryKey = 'EntityId';
    public $incrementing = false; // No auto-incremental
    protected $keyType = 'string';

    protected $fillable = [
        'TenantId',
        'TypeId',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'TenantId', 'TenantId');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'TypeId', 'TypeId');
    }

    public function stringValues(): HasMany
    {
        return $this->hasMany(StringValue::class, 'EntityId', 'EntityId');
    }

    public function integerValues(): HasMany
    {
        return $this->hasMany(IntegerValue::class, 'EntityId', 'EntityId');
    }

    public function decimalValues(): HasMany
    {
        return $this->hasMany(DecimalValue::class, 'EntityId', 'EntityId');
    }

    public function booleanValues(): HasMany
    {
        return $this->hasMany(BooleanValue::class, 'EntityId', 'EntityId');
    }

    public function dateValues(): HasMany
    {
        return $this->hasMany(DateValue::class, 'EntityId', 'EntityId');
    }

    public function ownedRelations(): HasMany
    {
        return $this->hasMany(ReferencesValue::class, 'OwnerEntityId', 'EntityId');
    }

    public function referencedInRelations(): HasMany
    {
        return $this->hasMany(ReferencesValue::class, 'ReferencedEntityId', 'EntityId');
    }
}
