<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServantMaterial extends Model
{
    protected $fillable = [
        'servant_id',
        'material_id',
        'amount',
        'ascension_level',
    ];


    public function servant()
    {
        return $this->belongsTo(Servant::class);
    }


    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
