<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'Types';
    protected $primaryKey = 'TypeId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'TenantId',
        'NameType',
        'IsPrimitive',
        'PrimitiveValueTableName',
    ];

    protected $casts = [
        'IsPrimitive' => 'boolean',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'TenantId', 'TenantId');
    }

    public function entities(): HasMany
    {
        return $this->hasMany(Entity::class, 'TypeId', 'TypeId');
    }

    public function definedProperties(): HasMany
    {
        return $this->hasMany(Property::class, 'OwnerTypeId', 'TypeId');
    }

    public function definedRelations(): HasMany
    {
        return $this->hasMany(Relation::class, 'OwnerTypeId', 'TypeId');
    }

    public function targetedInRelations(): HasMany
    {
        return $this->hasMany(Relation::class, 'TargetEntityTypeId', 'TypeId');
    }

    public function usedAsPropertyDataType(): HasMany
    {
        return $this->hasMany(Property::class, 'DataTypeId', 'TypeId');
    }
}
