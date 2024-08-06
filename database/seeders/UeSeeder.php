<?php

namespace Database\Seeders;

use App\Models\Ue;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ues = [
            ['libelle' => 'Mathématiques', 'coef' => 4],
            ['libelle' => 'Informatique', 'coef' => 3.5],
            ['libelle' => 'Physique', 'coef' => 3],
            ['libelle' => 'Chimie', 'coef' => 2.5],
            ['libelle' => 'Biologie', 'coef' => 2],
            ['libelle' => 'Langues', 'coef' => 1.5],
            ['libelle' => 'Sciences Humaines', 'coef' => 1],
            ['libelle' => 'Économie', 'coef' => 2],
        ];

        foreach ($ues as $ue) {
            Ue::factory()->create([
                'libelle' => $ue['libelle'],
                'coef' => $ue['coef'],
            ]);
        }
    }
}
