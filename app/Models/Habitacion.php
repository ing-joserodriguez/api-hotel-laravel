<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Habitacion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'habitaciones as h';

    public $timestamps = true;

    protected $fillable = [
        'tipo_habitacion_id',
        'nombre',
        'estado'
    ];

}
