<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReferencesValue extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'ReferencesValues';
    protected $primaryKey = null; // Clave primaria compuesta
    public $incrementing = false; // No auto-incremental

    protected $fillable = [
        'OwnerEntityId',
        'RelationId',
        'ReferencedEntityId',
        'Sequence',
    ];

    public function ownerEntity(): BelongsTo
    {
        return $this->belongsTo(Entity::class, 'OwnerEntityId', 'EntityId');
    }

    public function relation(): BelongsTo
    {
        return $this->belongsTo(Relation::class, 'RelationId', 'RelationId');
    }

    public function referencedEntity(): BelongsTo
    {
        return $this->belongsTo(Entity::class, 'ReferencedEntityId', 'EntityId');
    }
}
