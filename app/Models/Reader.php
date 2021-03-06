<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    use HasFactory;

    public function books(){
        return $this->hasOne(book::class);
    }
    protected $fillable
        = [
            'FIO',
            'date_reg',
            'date_birth',
        ];
}
