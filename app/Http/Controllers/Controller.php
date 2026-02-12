<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

abstract class Controller
{
    public function handleException(callable $callback)
    {
        try {
           return $callback();
        } catch (\Throwable $th) {
            return $this->error(
                $th->getMessage(),
                null,
                500
            );
        }
    }

    public function ownerid($req){
        return $req->user()->id;
    }

    function generateUniqueCode(string $code, string $table, string $field): string
    {

        $datePrefix = Carbon::now()->format('ymd'); // 260207
        $trxCode =  $code;

        $prefix = $datePrefix . $trxCode;

        $last = DB::table($table)
            ->where($field, 'like', $prefix . '%')
            ->orderBy($field, 'desc')
            ->value($field);

        if ($last) {
            $lastNumber = (int) substr($last, -6);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $prefix . '-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
}
