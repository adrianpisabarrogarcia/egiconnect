<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'proyecto';
    protected $fillable = ["nombre", "descripcion", "codigo", "idcreador"];
}
