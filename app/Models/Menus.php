<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'menus';
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;

    protected $hidden = [
        'owner_id',
    ];
}
