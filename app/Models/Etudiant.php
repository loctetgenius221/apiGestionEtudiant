<?php

namespace App\Models;

use App\Models\Evaluation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
