<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resource extends Model
{
    protected $primaryKey = 'resourceID';
    public $timestamps = false;

    protected $fillable = [
        'clubID',
        'title',
        'description',
        'file_path',
        'created_at',
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'clubID');
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'resourceID');
    }
}
