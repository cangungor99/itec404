<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Membership extends Model
{
    protected $primaryKey = 'membershipID';
    public $timestamps = false;

    protected $fillable = [
        'userID',
        'clubID',
        'role',
        'joined_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'clubID');
    }
}
