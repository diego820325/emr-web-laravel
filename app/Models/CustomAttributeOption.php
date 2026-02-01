<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomAttributeOption extends Model
{
    /** @use HasFactory<\Database\Factories\CustomAttributeOptionFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['custom_attribute_id', 'text'];
}
