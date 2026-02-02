<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    /** @use HasFactory<\Database\Factories\RecordFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['date', 'notes', 'patient_id', 'file1', 'file2', 'file3'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function customAttributeValues()
    {
        return $this->hasMany(CustomAttributeValue::class);
    }
}
