<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $primaryKey = 'unique_code';
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(
            SalesDetail::class,
            'unique_code',
            'unique_code'
        );
    }
}