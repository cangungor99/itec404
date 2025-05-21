<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $primaryKey = 'roleID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['name'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'role_user',
            'roleID',
            'userID'
        );
    }
}
