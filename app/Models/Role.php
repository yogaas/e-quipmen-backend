<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'role';
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;

    protected $hidden = [
        'owner_id',
    ];

    function menus()
    {
        return $this->hasMany(RoleMenu::class, 'role', 'role');
    }
}