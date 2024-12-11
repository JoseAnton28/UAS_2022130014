<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teambuilder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name_team',
        'description',
        'craftessence_id',
    ];


    public function servants()
    {
        return $this->belongsToMany(Servant::class, 'teambuilder_servants')
            ->withPivot('craftessence_id')
            ->with('craftessence'); // Tambahkan eager loading untuk craftessence
    }



    public function craftEssences()
    {
        return $this->belongsToMany(Craftessence::class, 'teambuilder_servants', 'teambuilder_id', 'craftessence_id')
            ->withPivot('servant_id');
    }
}


