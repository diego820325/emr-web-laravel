<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    /** @use HasFactory<\Database\Factories\RecordFactory> */
    use HasFactory;

    protected $fillable = ['date', 'notes', 'patient_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
