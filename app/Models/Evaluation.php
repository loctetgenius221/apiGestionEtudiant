<?php

namespace App\Models;

use App\Models\Matiere;
use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function etudiant() {
        return $this->belongsTo(Etudiant::class);
    }

    public function matiere() {
        return $this->belongsTo(Matiere::class);
    }
}
