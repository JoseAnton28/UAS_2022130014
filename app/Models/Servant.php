<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_sv',
        'class_sv',
        'rarity_sv',
        'max_level_sv',
        'base_hp_sv',
        'base_atk_sv',
        'img_sv',
    ];

    
    public function craftessence()
    {
        return $this->belongsTo(Craftessence::class, 'craftessence_id');
    }
}

