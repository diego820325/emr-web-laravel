<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([UserScope::class])]
class CustomAttribute extends Model
{
    /** @use HasFactory<\Database\Factories\CustomAttributeFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['section_id', 'question', 'custom_attribute_type_id'];

    public function options()
    {
        return $this->hasMany(CustomAttributeOption::class);
    }

    public function customAttributeType()
    {
        return $this->belongsTo(CustomAttributeType::class);
    }
}
