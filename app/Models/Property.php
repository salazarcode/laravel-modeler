<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'Properties';
    protected $primaryKey = 'PropertyId';
    public $incrementing = true; // Auto-incremental para el ID
    protected $keyType = 'int';

    protected $fillable = [
        'TenantId',
        'OwnerTypeId',
        'NameProperty',
        'DataTypeId',
        'CardinalityMin',
        'CardinalityMax',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'TenantId', 'TenantId');
    }

    public function ownerType(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'OwnerTypeId', 'TypeId');
    }

    public function dataType(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'DataTypeId', 'TypeId');
    }
}
