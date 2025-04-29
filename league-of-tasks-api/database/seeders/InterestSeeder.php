<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('interests')->insert([
            ['interest_name' => 'Sport', 'interest_description' => 'Activités physiques et entraînements pour rester en forme.'],
            ['interest_name' => 'Lecture', 'interest_description' => 'Découvrir et lire des livres de divers genres.'],
            ['interest_name' => 'Développement personnel', 'interest_description' => 'Améliorer ses compétences et son mindset.'],
            ['interest_name' => 'Alimentation', 'interest_description' => 'Manger sainement et en apprendre plus sur la nutrition.'],
            ['interest_name' => 'Finance', 'interest_description' => 'Gérer son argent, investir et économiser intelligemment.'],
            ['interest_name' => 'Productivité', 'interest_description' => 'Maximiser son efficacité et bien gérer son temps.'],
            ['interest_name' => 'Langues', 'interest_description' => 'Apprendre de nouvelles langues et améliorer ses compétences linguistiques.'],
            ['interest_name' => 'Art', 'interest_description' => 'Exploration des différentes formes d\'art : dessin, musique, écriture, etc.'],
            ['interest_name' => 'Relations', 'interest_description' => 'Développer de meilleures relations interpersonnelles.'],
            ['interest_name' => 'Bien-être', 'interest_description' => 'Prendre soin de sa santé mentale et physique.'],
            ['interest_name' => 'Aventures', 'interest_description' => 'Voyager et découvrir de nouvelles expériences.'],
            ['interest_name' => 'Sécurité', 'interest_description' => 'Apprendre des pratiques pour assurer sa sécurité personnelle et numérique.'],
            ['interest_name' => 'Tâches Ménagères', 'interest_description' => 'Organisation et entretien du foyer.'],
        ]);
    }
}
