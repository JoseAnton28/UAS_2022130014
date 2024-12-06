<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterPlanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'servant_id',
        'materials',
    ];

    
    public function servant()
    {
        return $this->belongsTo(Servant::class);
    }

    public function materials()
{
    return $this->belongsToMany(Material::class, 'character_planner_material')
        ->withPivot('amount');
}



    
    public function getMaterialsAttribute($value)
{
    return json_decode($value, true);
}

}
