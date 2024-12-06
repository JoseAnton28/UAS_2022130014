<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Craftessence extends Model
{
    use HasFactory;

    
    protected $table = 'craftessences'; 


    protected $fillable = [
        'name_ce',
        'rarity_ce',
        'max_level_ce',
        'base_attack_ce',
        'base_hp_ce',
        'effects_ce',
        'img_ce',
    ];

}
