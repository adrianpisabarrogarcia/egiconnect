<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usupro extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'usupro';
    protected $fillable = ["id","idproy", "idusu"];
}
