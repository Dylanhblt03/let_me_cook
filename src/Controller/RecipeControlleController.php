<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RecipeControlleController extends AbstractController
{
    #[Route('/recettes', name: 'app_recettes')]
    public function index(Request $request, RecipeRepository $recipeRepository): Response
    {
        $difficulte = $request->query->get('difficulte');
        $duree = $request->query->get('duree');
        $auteur = $request->query->get('auteur');

        $recipes = $recipeRepository->findByFilters($difficulte, $duree, $auteur);

        return $this->render('all_recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }
}
