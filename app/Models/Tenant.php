<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'Tenants';
    protected $primaryKey = 'TenantId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'Name',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'TenantId', 'TenantId');
    }

    public function types(): HasMany
    {
        return $this->hasMany(Type::class, 'TenantId', 'TenantId');
    }

    public function entities(): HasMany
    {
        return $this->hasMany(Entity::class, 'TenantId', 'TenantId');
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'TenantId', 'TenantId');
    }

    public function relations(): HasMany
    {
        return $this->hasMany(Relation::class, 'TenantId', 'TenantId');
    }
}
