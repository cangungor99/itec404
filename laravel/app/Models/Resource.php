<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Resource extends Model
{
    protected $primaryKey = 'resourceID';
    public $timestamps = false;
    use HasFactory;

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
