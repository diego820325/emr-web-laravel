<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([UserScope::class])]
class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email', 'phone', 'notes'];

    public function records(): HasMany
    {
        return $this->hasMany(Record::class)->orderBy('date', 'desc');
    }

    public function customAttributeValues()
    {
        return $this->hasMany(CustomAttributeValue::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
