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

    public function servants()
{
    return $this->belongsToMany(Servant::class, 'servant_material')
                ->withPivot('amount')
                ->withTimestamps();
}
    
public function characterPlanners()
{
    return $this->belongsToMany(CharacterPlanner::class, 'character_planner_material')
                ->withPivot('amount')
                ->withTimestamps();
}


    public static function getTypes()
    {
        return [
            'Bronze',
            'Silver',
            'Gold',
        ];
    }
}
