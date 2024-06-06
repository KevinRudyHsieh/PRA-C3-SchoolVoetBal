<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class results extends Model
{
    use HasFactory;

    protected $fillable = [
        'team1_id',
        'team1_name',
        'team1_score',
        'team2_id',
        'team2_name',
        'team2_score',
        'winner_id'

    ];

    public function toernooi()
    {
        return $this->belongsTo(Toernooi::class);
    }

}