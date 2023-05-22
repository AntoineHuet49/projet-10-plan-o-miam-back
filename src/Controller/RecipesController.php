<?php

namespace App\Controller;

use App\Repository\RecipesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RecipesController extends AbstractController
{
    /**
     * Get all recipes
     * 
     * @Route("/api/recipes", name="api_recipes_browse", methods={"GET"})
     *
     * @param RecipesRepository $recipesRepository
     * @param SerializerInterface $serializerInterface
     * @return JsonResponse
     */
    public function browse(RecipesRepository $recipesRepository, SerializerInterface $serializerInterface): JsonResponse
    {
        $recipes = $recipesRepository->findAll();

        return $this->json([
            'recipes' => $recipes
        ],
        Response::HTTP_OK,
        [],
        [
            "groups" => "list_recipes"
        ]
        );
    }

    /**
     * @Route("/api/recipes/{id<\d+>}", name="api_recipes_read", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function read(int $id, RecipesRepository $recipesRepository, SerializerInterface $serializerInterface): JsonResponse
    {
        $recipe = $recipesRepository->find($id);

        if($recipe === null) {
            return $this->json([
                'error' => 'Cette recette n\'existe pas'
            ],
            Response::HTTP_NOT_FOUND
            );
        }

        return $this->json([
            'recipe' => $recipe
        ],
        Response::HTTP_OK,
        [],
        [
            'groups' => 'recipe'
        ]  
        );
    }
}
