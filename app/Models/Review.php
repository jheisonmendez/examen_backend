<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        "codigo",
        "aceite",
        "filtro",
        "frenos",
        "car_id",
    ];
    public function car(){
        return $this->belongsTo('App\Models\Car');
    }
}
