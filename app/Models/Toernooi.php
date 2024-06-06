<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toernooi extends Model
{
    use HasFactory;

    protected $table = 'toernooi';

    protected $fillable = [
        'name',
        'fields',
        'date',
        'match_duration',
    ];

    public function matches()
    {
        return $this->hasMany(matches::class);
    }
}
