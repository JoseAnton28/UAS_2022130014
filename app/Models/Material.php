<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'name_mt',
        'type_mt',
        'drop_location_mt',
        'img_mt',
    ];

    public static function getTypes()
    {
        return [
            'Bronze',
            'Silver',
            'Gold',
        ];
    }
}
