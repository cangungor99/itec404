<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Membership extends Model
{
    protected $primaryKey = 'membershipID';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'userID',
        'clubID',
        'role',
        'joined_at',
        'status',
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
