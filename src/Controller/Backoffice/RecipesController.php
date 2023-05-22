<?php

namespace App\Controller\Backoffice;

use App\Entity\Recipes;
use App\Form\RecipesType;
use App\Repository\RecipesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/recipes")
 */
class RecipesController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_recipes_index", methods={"GET"})
     */
    public function index(RecipesRepository $recipesRepository): Response
    {
        return $this->render('backoffice/recipes/index.html.twig', [
            'recipes' => $recipesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_backoffice_recipes_new", methods={"GET", "POST"})
     */
    public function new(Request $request, RecipesRepository $recipesRepository): Response
    {
        $recipe = new Recipes();
        $form = $this->createForm(RecipesType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipesRepository->add($recipe, true);

            return $this->redirectToRoute('app_backoffice_recipes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/recipes/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_recipes_show", methods={"GET"})
     */
    public function show(Recipes $recipe): Response
    {
        return $this->render('backoffice/recipes/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_backoffice_recipes_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Recipes $recipe, RecipesRepository $recipesRepository): Response
    {
        $form = $this->createForm(RecipesType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipesRepository->add($recipe, true);

            return $this->redirectToRoute('app_backoffice_recipes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/recipes/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_recipes_delete", methods={"POST"})
     */
    public function delete(Request $request, Recipes $recipe, RecipesRepository $recipesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recipe->getId(), $request->request->get('_token'))) {
            $recipesRepository->remove($recipe, true);
        }

        return $this->redirectToRoute('app_backoffice_recipes_index', [], Response::HTTP_SEE_OTHER);
    }
}
