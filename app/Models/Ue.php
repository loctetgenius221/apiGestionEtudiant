<?php

namespace App\Models;

use App\Models\Matiere;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function matieres() {
        return $this->hasMany(Matiere::class);
    }
}
