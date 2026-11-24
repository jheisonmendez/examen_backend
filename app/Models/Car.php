<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        "marca",
        "modelo",
        "color",
        "precio",
        'imagen_url',
        'imagen_public_id',
        "client_id"
    ];
    public function client(){
        return $this->belongsTo('App\Models\Client');
    }
    public function reviews(){
        return $this->hasMany('App\Models\Review');
    }
}
