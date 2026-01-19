<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['name', 'path', 'record_id'];

    public function record()
    {
        return $this->belongsTo(Record::class);
    }
}
