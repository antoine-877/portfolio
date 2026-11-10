<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Création des tags sans doublons
        $vue = Tag::firstOrCreate(
            ['slug' => 'vue-js'],
            ['name' => 'Vue.js']
        );

        $laravel = Tag::firstOrCreate(
            ['slug' => 'laravel'],
            ['name' => 'Laravel']
        );

        $javascript = Tag::firstOrCreate(
            ['slug' => 'javascript'],
            ['name' => 'JavaScript']
        );

        // Projet 1 : Météo Wavre
        $meteo = Project::updateOrCreate(
            ['slug' => 'meteo-wavre'],
            [
                'title' => 'Météo Wavre',
                'summary' => 'Une page qui affiche la météo de Wavre heure par heure à partir d\'une API publique.',
                'content' => '<p>Projet du cours de scripts clients à l\'IFOSUP Wavre. Le sujet était libre, avec une contrainte : lire en JavaScript les données d\'une API publique, un service en ligne qui répond en JSON. Je voulais savoir s\'il fallait prendre un parapluie pour venir au cours.</p>'
                    . '<p>Seul, du HTML à la mise en ligne. Le professeur fournissait seulement la liste des API autorisées.</p>'
                    . '<p>Les sites de météo affichent beaucoup de publicités et de menus. Je voulais une seule page, lisible sur téléphone, qui montre la température et le risque de pluie à Wavre pour les douze prochaines heures.</p>'
                    . '<p>L\'API Open-Meteo, parce qu\'elle est gratuite et ne demande pas de clé. Un appel avec <code>fetch</code>, puis une boucle qui construit une ligne par heure. Le graphique des températures est un petit SVG que je dessine moi-même, pour ne charger aucune bibliothèque. Le mode sombre suit le réglage du téléphone, grâce à la règle CSS <code>prefers-color-scheme</code>.</p>'
                    . '<p>La page affiche douze heures de prévisions, mises à jour à chaque visite. Elle est en ligne sur GitHub Pages. Les prévisions sont réelles, mais seulement pour Wavre.</p>'
                    . '<p>Quand l\'API ne répond pas, la page reste blanche, sans aucun message. J\'afficherais une erreur claire et la dernière prévision reçue. Je laisserais aussi choisir une autre commune que Wavre.</p>',
                'cover_path' => 'images/meteo-wavre.jpg',
                'demo_url' => 'https://example.com/meteo',
                'repo_url' => 'https://github.com/exemple/meteo-wavre',
                'published_at' => now(),
                'position' => 1,
            ]
        );

        $meteo->tags()->syncWithoutDetaching([$javascript->id]);

        // Projet 2 : Quiz des capitales
        $quiz = Project::updateOrCreate(
            ['slug' => 'quiz-des-capitales'],
            [
                'title' => 'Quiz des capitales',
                'summary' => 'Un quiz de géographie en Vue.js avec score, minuteur et classement local.',
                'content' => '<p>Projet du cours d\'interfaces à l\'IFOSUP Wavre, où j\'ai découvert Vue.js. La consigne demandait un petit jeu en plusieurs composants. J\'ai choisi un quiz sur les capitales d\'Europe, un sujet que tout le monde comprend sans explication.</p>'
                    . '<p>Seul. J\'ai écrit les questions, les composants et le style.</p>'
                    . '<p>Une partie compte dix questions. Le joueur a quinze secondes par question et voit son score à tout moment. Quand il revient le lendemain, il retrouve ses meilleurs scores, sans créer de compte.</p>'
                    . '<p>Vue.js 3 avec Vite, en trois composants : la question, le minuteur et le tableau des scores. Les trois lisent le même objet réactif, rangé dans un fichier à part. Quand le score change dans cet objet, chaque composant se met à jour sans code en plus. Les cinq meilleurs scores restent dans le <code>localStorage</code>, la mémoire du navigateur.</p>'
                    . '<p>Le quiz marche sur ordinateur et sur téléphone. Les quarante pays viennent d\'un fichier JSON que j\'ai rempli à la main. Le classement reste dans un seul navigateur : il n\'est pas partagé entre les joueurs.</p>'
                    . '<p>Le tirage au sort peut poser deux fois la même question dans une partie. Je tirerais les dix pays sans remise. J\'écrirais aussi des tests, car je n\'en ai écrit aucun.</p>',
                'cover_path' => 'images/quiz-capitales.jpg',
                'demo_url' => 'https://example.com/quiz',
                'repo_url' => 'https://github.com/exemple/quiz-capitales',
                'published_at' => now(),
                'position' => 2,
            ]
        );

        $quiz->tags()->syncWithoutDetaching([
            $vue->id,
            $javascript->id,
        ]);

        // Projet 3 : Carnet de recettes
        $recipes = Project::updateOrCreate(
            ['slug' => 'carnet-de-recettes'],
            [
                'title' => 'Carnet de recettes',
                'summary' => 'Une application Laravel pour classer ses recettes par saison et par ingrédient.',
                'content' => '<p>Projet libre du cours de framework côté serveur à l\'IFOSUP Wavre. Ma famille garde ses recettes dans un classeur et dans des photos sur nos téléphones. Je voulais les réunir dans une application, et retrouver une recette à partir de ce qui reste dans le frigo.</p>'
                    . '<p>Seul. J\'ai conçu la base de données et écrit les migrations, les contrôleurs, les vues et les tests.</p>'
                    . '<p>Une recette demande plusieurs ingrédients, et un ingrédient sert dans plusieurs recettes. Je devais pouvoir afficher toutes les recettes qui contiennent du potiron, ou seulement celles d\'automne.</p>'
                    . '<p>Laravel 13 avec des templates Blade et Tailwind CSS. Une table pivot relie les recettes et les ingrédients, et garde la quantité de chaque ingrédient. Une Form Request valide l\'ajout et la modification avec les mêmes règles. Des tests Pest vérifient les deux filtres, par saison et par ingrédient.</p>'
                    . '<p>L\'ajout, la modification, la suppression et les deux filtres fonctionnent, et les tests passent. Les vingt recettes de démonstration viennent du classeur familial. L\'application tourne seulement sur mon ordinateur : je ne l\'ai pas mise en ligne.</p>'
                    . '<p>La quantité est un texte libre, comme « 200 g » ou « une pincée ». L\'application ne peut donc pas recalculer une recette pour six personnes au lieu de quatre. Je stockerais un nombre et une unité dans deux colonnes séparées.</p>',
                'cover_path' => 'images/carnet-recettes.jpg',
                'demo_url' => null,
                'repo_url' => 'https://github.com/exemple/carnet-recettes',
                'published_at' => now(),
                'position' => 3,
            ]
        );

        $recipes->tags()->syncWithoutDetaching([$laravel->id]);
    }
}
