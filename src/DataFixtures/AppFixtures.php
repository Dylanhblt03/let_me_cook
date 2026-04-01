<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Recipe;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
    $recipes = [
                    [
                    'title' => 'Tarte aux pommes',
                    'duration' => 60,
                    'difficulty' => 'Facile',
                    'author' => 'Marie Dupont',
                    'description' => 'Une tarte dorée aux pommes caramélisées',
                    ],
                    [
                    'title' => 'Bœuf bourguignon',
                    'duration' => 180,
                    'difficulty' => 'Difficile',
                    'author' => 'Jean Martin',
                    'description' => 'Le grand classique mijoté au vin rouge',
                    ],
                    [
                    'title' => 'Salade César',
                    'duration' => 15,
                    'difficulty' => 'Facile',
                    'author' => 'Sophie Lambert',
                    'description' => 'Salade croquante avec croûtons et parmesan',
                    ],
                    [
                    'title' => 'Quiche lorraine',
                    'duration' => 50,
                    'difficulty' => 'Moyen',
                    'author' => 'Pierre Bernard',
                    'description' => 'La quiche traditionnelle aux lardons',
                    ],
                    [
                    'title' => 'Crème brûlée',
                    'duration' => 40,
                    'difficulty' => 'Moyen',
                    'author' => 'Marie Dupont',
                    'description' => 'Un dessert crémeux à la vanille',
                    ],
                    [
                    'title' => 'Ratatouille',
                    'duration' => 90,
                    'difficulty' => 'Moyen',
                    'author' => 'Jean Martin',
                    'description' => 'Légumes du soleil mijotés à la provençale',
                    ],
                    [
                    'title' => 'Omelette au fromage',
                    'duration' => 10,
                    'difficulty' => 'Facile',
                    'author' => 'Lucas Petit',
                    'description' => 'Une omelette rapide et gourmande',
                    ],
                    [
                    'title' => 'Soufflé au chocolat',
                    'duration' => 35,
                    'difficulty' => 'Difficile',
                    'author' => 'Sophie Lambert',
                    'description' => 'Un soufflé aérien au chocolat noir',
                    ],
        ];

        foreach ($recipes as $recipeData) {
            $recipe = new Recipe();
            $recipe->setTitle($recipeData['title']);
            $recipe->setDuration($recipeData['duration']);
            $recipe->setDifficulty($recipeData['difficulty']);
            $recipe->setAuthor($recipeData['author']);
            $recipe->setDescription($recipeData['description']);

            $manager->persist($recipe);
        }

        $manager->flush();
    }
}
