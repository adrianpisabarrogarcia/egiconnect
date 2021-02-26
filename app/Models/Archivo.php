<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'archivo';
    protected $fillable = ["id","ruta", "idproy", "idusu", "fecha"];
}


