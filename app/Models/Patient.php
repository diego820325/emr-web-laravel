<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'notes'];

    public function records(): HasMany
    {
        return $this->hasMany(Record::class)->orderBy('date', 'desc');
    }
}
