<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePayment extends Model
{
    use HasFactory;
    protected $table = 'type_payments';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}