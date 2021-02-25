<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'usuario';
    //Hay que añadir ids y usupro???
    protected $fillable = ["id","usuario", "nombre", "apellidos", "password", "email"];
}
