<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterPlanner extends Model
{
    protected $fillable = [
        'user_id', 
        'servant_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function servant()
    {
        return $this->belongsTo(Servant::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'character_planner_materials')
            ->withPivot('quantity');
    }
}