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
        'skills_sv',
        'np_sv',
        'ascension_sv',
        'img_sv',
    ];

    
    public function servantMaterials()
    {
        return $this->hasMany(ServantMaterial::class);
    }

    
    public function materials()
{
    return $this->belongsToMany(Material::class, 'servant_material')
                ->withPivot('amount')
                ->withTimestamps();
}

    public function craftessence()
    {
        return $this->belongsTo(Craftessence::class, 'craftessence_id');
    }
}

