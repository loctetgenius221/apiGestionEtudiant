<?php

namespace App\Models;

use App\Models\Ue;
use App\Models\Evaluation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matiere extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ue() {
        return $this->belongsTo(Ue::class);
    }

    public function evaluations() {
        return $this->hasMany(Evaluation::class);
    }
}
