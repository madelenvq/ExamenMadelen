<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class habitacion extends Model
{
    use HasFactory;

    protected $table = 'habitacion';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['id', 'tipo ', 'numero', 'precio ', 'fotografia'];

    protected $guarded = [];
}