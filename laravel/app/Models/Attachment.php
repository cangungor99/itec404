<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    protected $primaryKey = 'attachmentID';
    public $timestamps = false;

    protected $fillable = [
        'resourceID',
        'forumID',
        'file_path',
        'file_type',
        'uploaded_at',
    ];
    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'resourceID');
    }
    public function forum(): BelongsTo
    {
        return $this->belongsTo(Forum::class, 'forumID');
    }
}
