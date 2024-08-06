<?php

namespace Database\Seeders;

use App\Models\Ue;
use App\Models\Matiere;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MatiereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matieres = [
            'Algèbre', 'Analyse', 'Géométrie', 'Probabilités', 'Statistiques',
            'Programmation', 'Base de données', 'Réseaux', 'Algorithmes', 'Intelligence Artificielle',
            'Mécanique', 'Électricité', 'Optique', 'Thermodynamique', 'Mécanique quantique',
            'Chimie organique', 'Chimie inorganique', 'Biochimie', 'Chimie physique', 'Chimie analytique',
            'Génétique', 'Écologie', 'Biologie cellulaire', 'Physiologie', 'Microbiologie',
            'Anglais', 'Français', 'Espagnol', 'Allemand', 'Chinois',
            'Histoire', 'Géographie', 'Sociologie', 'Psychologie', 'Philosophie',
            'Microéconomie', 'Macroéconomie', 'Économétrie', 'Finance', 'Marketing'
        ];

        $ues = UE::all();

        foreach ($matieres as $matiere_libelle) {
            Matiere::factory()->create([
                'libelle' => $matiere_libelle,
                'ue_id' => $ues->random()->id,
            ]);
        }
    }
}
