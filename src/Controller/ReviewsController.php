<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Repository\RecipesRepository;
use App\Repository\ReviewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ReviewsController extends AbstractController
{
    /**
     * Add review in DataBase
     * 
     * @Route("/api/reviews", name="api_reviews_add", methods={"POST"})
     *
     * @param Request $request
     * @param RecipesRepository $recipesRepository
     * @param ReviewsRepository $reviewsRepository
     * @param SerializerInterface $serializerInterface
     * @return JsonResponse
     */
    public function add(Request $request, RecipesRepository $recipesRepository, ReviewsRepository $reviewsRepository, SerializerInterface $serializerInterface): JsonResponse
    {
        $review = new Reviews();

        $body = $request->toArray();
        
        $user = $this->getUser();
        
        $recipe = $recipesRepository->find($body["recipeId"]);
        
        if($recipe === null) {
            return $this->json([
                "error" => "Cette recette n'éxiste pas"
            ],
            Response::HTTP_NOT_FOUND
            );
        }

        if(empty($body["content"])) {
            return $this->json([
                "error" => "Le commantaire est vide"
            ],
            Response::HTTP_BAD_REQUEST
            );
        }
            
        $review->setContent($body["content"]);
        $review->setUser($user);
        $review->setRecipe($recipe);

        $reviewsRepository->add($review, true);

        return $this->json([
            'review' => $review
        ],
        Response::HTTP_OK,
        [],
        [
            'groups' => 'reviews_add'
        ]
        );
    }
}
