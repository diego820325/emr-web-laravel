<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomAttributeValue extends Model
{
    /** @use HasFactory<\Database\Factories\CustomAttributeValueFactory> */
    use HasFactory;

    protected $fillable = [
        'custom_attribute_id',
        'string_value',
        'text_value',
        'long_text_value',
        'number_value',
        'boolean_value',
        'date_value',
        'date_time_value',
        'custom_attribute_option_id',
    ];

    public function customAttribute()
    {
        return $this->belongsTo(CustomAttribute::class);
    }

    public function customAttributeOption()
    {
        return $this->belongsTo(CustomAttributeOption::class);
    }
}
