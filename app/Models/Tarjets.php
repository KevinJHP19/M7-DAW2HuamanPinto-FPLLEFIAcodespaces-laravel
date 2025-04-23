<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjets extends Model
{
    use HasFactory;
    protected $table = 'tarjets';
    protected $fillable = [
        'name', 'image'
    ];


}
