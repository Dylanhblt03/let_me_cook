<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RecipeControlleController extends AbstractController
{
    #[Route('/recipes', name: 'app_recettes')]
    public function index(Request $request, RecipeRepository $recipeRepository): Response
    {
        $difficulte = $request->query->get('difficulte');
        $duree = $request->query->get('duree');
        $auteur = $request->query->get('auteur');

        if ($difficulte || $duree || $auteur) {
            $recipes = $recipeRepository->findByFilters($difficulte, $duree, $auteur);
        } else {
            $recipes = $recipeRepository->findAll();
        }

        return $this->render('all_recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    #[Route('/recipes/{id}', name: 'app_recette_detail')]
    public function show(Recipe $recipe): Response
    {
        return $this->render('all_recipe/detail.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    #[Route('/recipes/author/{author}', name: 'app_recettes_auteur', priority: 1)]
    public function byAuthor(string $author, RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findBy(['author' => $author]);

        return $this->render('all_recipe/author.html.twig', [
            'recipes' => $recipes,
            'author' => $author,
        ]);
    }
}
