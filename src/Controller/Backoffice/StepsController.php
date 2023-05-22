<?php

namespace App\Controller\Backoffice;

use App\Entity\Steps;
use App\Form\StepsType;
use App\Repository\StepsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/steps")
 */
class StepsController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_steps_index", methods={"GET"})
     */
    public function index(StepsRepository $stepsRepository): Response
    {
        return $this->render('backoffice/steps/index.html.twig', [
            'steps' => $stepsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_backoffice_steps_new", methods={"GET", "POST"})
     */
    public function new(Request $request, StepsRepository $stepsRepository): Response
    {
        $step = new Steps();
        $form = $this->createForm(StepsType::class, $step);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stepsRepository->add($step, true);

            return $this->redirectToRoute('app_backoffice_steps_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/steps/new.html.twig', [
            'step' => $step,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_steps_show", methods={"GET"})
     */
    public function show(Steps $step): Response
    {
        return $this->render('backoffice/steps/show.html.twig', [
            'step' => $step,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_backoffice_steps_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Steps $step, StepsRepository $stepsRepository): Response
    {
        $form = $this->createForm(StepsType::class, $step);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stepsRepository->add($step, true);

            return $this->redirectToRoute('app_backoffice_steps_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/steps/edit.html.twig', [
            'step' => $step,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_steps_delete", methods={"POST"})
     */
    public function delete(Request $request, Steps $step, StepsRepository $stepsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$step->getId(), $request->request->get('_token'))) {
            $stepsRepository->remove($step, true);
        }

        return $this->redirectToRoute('app_backoffice_steps_index', [], Response::HTTP_SEE_OTHER);
    }
}
