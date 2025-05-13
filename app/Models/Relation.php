<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Relation extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'Relations';
    protected $primaryKey = 'RelationId';
    public $incrementing = true; // Auto-incremental para el ID
    protected $keyType = 'int';

    protected $fillable = [
        'TenantId',
        'OwnerTypeId',
        'NameRelationRole',
        'TargetEntityTypeId',
        'CardinalityMin',
        'CardinalityMax',
        'IsComposition',
        'InverseRelationId',
        'ConceptualAssociationName',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'TenantId', 'TenantId');
    }

    public function ownerType(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'OwnerTypeId', 'TypeId');
    }

    public function targetEntityType(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'TargetEntityTypeId', 'TypeId');
    }

    public function inverseRelation(): BelongsTo
    {
        return $this->belongsTo(Relation::class, 'InverseRelationId', 'RelationId');
    }
}
