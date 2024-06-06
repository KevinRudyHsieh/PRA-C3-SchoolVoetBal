<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'toernooi_id',
        'team_a_id', 
        'team_b_id',
        'matchField',
        'status',
        'team_a_score',
        'team_b_score',

    ];

    public function toernooi()
    {
        return $this->belongsTo(Toernooi::class);
    }

}
