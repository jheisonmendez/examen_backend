<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        "cedula",
        "direccion",
        "telefono",
    ];
    protected $hidden = ["dirrecion"];
    protected $appends = ["direccion"];

    public function getDireccionAttribute(): ?string
    {
        return $this->attributes["dirrecion"] ?? null;
    }

    public function setDireccionAttribute(string $value): void
    {
        $this->attributes["dirrecion"] = $value;
    }

    public function cars(){
        return $this->hasMany('App\Models\Car');
    }
}
