<?php

namespace App\Controller;

use App\Entity\Lunchs;
use App\Repository\GroupsRepository;
use App\Repository\LunchsRepository;
use App\Repository\RecipesRepository;
use App\Repository\UserRepository;
use DateInterval;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class LunchController extends AbstractController
{
    /**
     * Lunch for calandar
     * 
     * @Route("/api/lunchs", name="api_lunchs_week", methods={"GET"})
     *
     * @param LunchsRepository $lunchsRepository
     * 
     * @return JsonResponse
     */
    public function week(LunchsRepository $lunchsRepository, NormalizerInterface $normalizerInterface): JsonResponse
    {
        // récupère toute les dates de la semaine
        $monday = strtotime('Monday this week');
        $monday = date_timestamp_set(new DateTime(), $monday);
        
        $tuesday = strtotime('Tuesday this week');
        $tuesday = date_timestamp_set(new DateTime(), $tuesday);
        
        $wednesday = strtotime('Wednesday this week');
        $wednesday = date_timestamp_set(new DateTime(), $wednesday);
        
        $thursday = strtotime('Thursday this week');
        $thursday = date_timestamp_set(new DateTime(), $thursday);
        
        $friday = strtotime('Friday this week');
        $friday = date_timestamp_set(new DateTime(), $friday);
        
        $saturday = strtotime('Saturday this week');
        $saturday = date_timestamp_set(new DateTime(), $saturday);
        
        $sunday = strtotime('Sunday this week');
        $sunday = date_timestamp_set(new DateTime(), $sunday);       

        $user = $this->getUser();
        $groups = $user->getGroups();

        //TODO: V2 gestion de plusieur groupe
        $group = null;

        foreach($groups as $group) {
            $group = $group;
        }
       
        // récupère les recettes par jours
        if($group != null) {
            $mondayLunchs = $lunchsRepository->findByDate($monday, $monday, $group->getId());
            $tuesdayLunchs = $lunchsRepository->findByDate($tuesday, $tuesday, $group->getId());
            $wednesdayLunchs = $lunchsRepository->findByDate($wednesday, $wednesday, $group->getId());
            $thursdayLunchs = $lunchsRepository->findByDate($thursday, $thursday, $group->getId());
            $fridayLunchs = $lunchsRepository->findByDate($friday, $friday, $group->getId());
            $saturdayLunchs = $lunchsRepository->findByDate($saturday, $saturday, $group->getId());
            $sundayLunchs = $lunchsRepository->findByDate($sunday, $sunday, $group->getId());
        }
        else {
            return $this->json([
                "error" => "cet utilisateur n'a pas de tablée"
            ],
            Response::HTTP_NOT_FOUND
            );
        }
        
        $dayLunchs = [
            "Monday" => $mondayLunchs,
            "Tuesday" => $tuesdayLunchs,
            "Wednesday" => $wednesdayLunchs,
            "Thursday" => $thursdayLunchs,
            "Friday" => $fridayLunchs,
            "Saturday" => $saturdayLunchs,
            "Sunday" => $sundayLunchs
        ];
        
        $lunch = [];

        //TODO: trouver un moyen de créé tout les lunch d'une semaine d'un groupe en bdd (vide)
        foreach ($dayLunchs as $key => $lunch) {
            // si les jour ne sont pas vide
            if (!empty($lunch)) {
                // si les jour contienne 2 repas et que le premier repas est celui du soir
                if (count($lunch) === 2 && $lunch[0]->getTime() === "soir") {
                    // on inverse les 2 repas
                    $lunch = array_reverse($lunch);
                }
                // si le jour ne contient qu'un repas
                if (count($lunch) === 1) {
                    // on ajoute un repas vide au moment de la journé ou il n'y as pas de repas
                    $emptyLunch = new Lunchs();
                    $emptyLunch->setDate($lunch[0]->getDate());
                    $lunch[] = $emptyLunch;
                    
                    if ($lunch[0]->getTime() === "soir") {
                        $lunch[1]->setTime("midi");
                        
                        $lunch = array_reverse($lunch);
                    }
                    else {
                        $lunch[1]->setTime("soir");
                    }
                }
            }
            // si le jour est vide on set 2 repas vide
            else {
                for ($i = 0; $i < 2; $i ++) {
                    $emptyLunch = new Lunchs();

                    $lunch[] = $emptyLunch;
                    }

                $lunch[0]->setTime("midi");
                $lunch[1]->setTime("soir");
            }

            $lunchs[$key] = $lunch;
        }
        
        // on rajoute les bonne date a tout les jour
        $i = 0;
        foreach ($lunchs as $lunchEntity) {
            $monday = strtotime('Monday this week');
            $monday = date_timestamp_set(new DateTime(), $monday);
            
            $interval = DateInterval::createFromDateString($i . 'day');
            $datetime = date_add($monday, $interval);

            foreach ($lunchEntity as $date) {
                if ($date->getdate() === null) {
                    $date->setDate($datetime);
                }
            }
            $i++;
        }

        $mondayLunchs = $lunchs['Monday'];
        $tuesdayLunchs = $lunchs['Tuesday'];
        $wednesdayLunchs = $lunchs['Wednesday'];
        $thursdayLunchs = $lunchs['Thursday'];
        $fridayLunchs = $lunchs['Friday'];
        $saturdayLunchs = $lunchs['Saturday'];
        $sundayLunchs = $lunchs['Sunday'];

        return $this->json([
            $mondayLunchs,
            $tuesdayLunchs,
            $wednesdayLunchs,
            $thursdayLunchs,
            $fridayLunchs,
            $saturdayLunchs,
            $sundayLunchs
        ],
        Response::HTTP_OK,
        [],
        [
            "groups" => "week_lunch"
        ]
        );
    }

    /**
     * ajout d'une recette sur un repas par un user
     * 
     * @Route("/api/lunchs", name="api_lunchs_add", methods={"POST"})
     *
     * @param Request $request
     * @param RecipesRepository $recipesRepository
     * @param LunchsRepository $lunchsRepository
     * 
     * @return JsonResponse
     */
    public function addRecipeToLunch(Request $request, 
    RecipesRepository $recipesRepository,
    LunchsRepository $lunchsRepository
    ): JsonResponse
    {
        $arrayRequest = $request->toArray();

        // je récupère le jour demander pour l'ajouté en bdd
        $newLunch = new Lunchs();
        $date = new DateTime($arrayRequest["date"]);
        
        // je récupère mon groupe
        $user = $this->getUser();
        $groups = $user->getGroups();
        
        //TODO: V2 récupération de quel groupe visée par une donné envoié du front (je dois donc leur envoyé d'abord)
        foreach($groups as $group) {
            $group = $group;
        }

        // verification que l'on nous donne bien "midi" ou "soir" dans la propriété time
        if($arrayRequest["time"] !== "midi" && $arrayRequest["time"] !== "soir") {
            return $this->json([
                "error" => "La variable time doit contenir midi ou soir"
            ],
            Response::HTTP_BAD_REQUEST);
        }

        // Verification qu'un repas n'a pas deja été ajouté a cette date et ce moment (soir ou midi)
        $lunchAlreadyAdd = $lunchsRepository->findByDate($date, $date, $group);

        if(!empty($lunchAlreadyAdd)) {
            // si les 2 repas du jour on deja été ajouté
            if(count($lunchAlreadyAdd) > 1) {
                return $this->json([
                    "error" => "Les 2 repas du jour on été ajouté, passer par la route de mofdification"
                ],
                Response::HTTP_METHOD_NOT_ALLOWED);
            }
            // si le repas ajouté est aumême moment de la journée
            if(count($lunchAlreadyAdd) > 0 && $arrayRequest['time'] === $lunchAlreadyAdd[0]->getTime()) {
                return $this->json([
                    "error" => "Le repas du " . $lunchAlreadyAdd[0]->getTime() . " a déja été ajouté"
                ],
                Response::HTTP_METHOD_NOT_ALLOWED);
            }
        }

        // je récupère ma recette
        $recipe = $recipesRepository->find($arrayRequest["recipeId"]);

        if($recipe === null) {
            return $this->json([
                "error" => "Cette recette n'éxiste pas"
            ],
            Response::HTTP_NOT_FOUND
            );
        }

        // je récupère le temps de mon repas (midi ou soir)
        $time = $arrayRequest["time"];
        
        // je lie le repas et le groupe au nouveau repas
        $newLunch->setDate($date);
        $newLunch->addGroup($group);
        $newLunch->addRecipe($recipe);
        $newLunch->setTime($time);

        $lunchsRepository->add($newLunch, true);

        return $this->json([
            "newLunch" => $newLunch
        ],
        Response::HTTP_OK,
        [],
        [
            "groups" => "new_lunch"
        ]
        );
    }

    //TODO: faire une route pour une modification du calandrier
    /**
     * Modification de la recete choisit pour un jour donnée
     * 
     * @Route("/api/lunchs", name="api_lunchs_edit", methods={"PUT"})
     *
     * @param Request $request
     * @param LunchsRepository $lunchsRepository
     * @return JsonResponse
     */
    public function edit(Request $request, LunchsRepository $lunchsRepository, RecipesRepository $recipesRepository): JsonResponse
    {
        $arrayRequest = $request->toArray();
        // je récupère le user puis le groupe
        $user = $this->getUser();
        $groups = $user->getGroups();

        //TODO: V2 gestion de plusieur groupe pour le même user
        foreach($groups as $group) {
            $group = $group;
        }

        $date = $arrayRequest['date'];
        // je vais chercher les repas en BDD
        $lunchAlreadyAdd = $lunchsRepository->findByDate($date, $date, $group);

        // verification que l'on nous donne bien "midi" ou "soir" dans la propriété time
        if($arrayRequest["time"] !== "midi" && $arrayRequest["time"] !== "soir") {
            return $this->json([
                "error" => "La variable time doit contenir midi ou soir"
            ],
            Response::HTTP_BAD_REQUEST);
        }

        if(empty($lunchAlreadyAdd)) {
            return $this->json([
                "error" => "Aucun repas n'a été ajouté pour cette date"
            ],
            Response::HTTP_NOT_FOUND);
        }

        if(count($lunchAlreadyAdd) === 1) {
            if($lunchAlreadyAdd[0]->getTime() !== $arrayRequest["time"]) {
                return $this->json([
                    "error" => "aucun repas n'a été choisie pour le " . $arrayRequest["time"]
                ],
                Response::HTTP_NOT_FOUND);
            }
            $lunchToChange = $lunchAlreadyAdd[0];
        }

        if (count($lunchAlreadyAdd) === 2) {
            foreach($lunchAlreadyAdd as $lunch) {
                if($lunch->getTime() === $arrayRequest["time"]) {
                    $lunchToChange = $lunch;
                }
            }
        }
//TODO: changer la relation recipe_lunch => une recette peut avoir plusieur repas, un repas ne peut avoir qu'une recette
        // je récupère l'ancienne recette
        $recipes = $lunchToChange->getRecipes();
        foreach($recipes as $recipeToRemove) {
            $recipeToRemove = $recipeToRemove;
        }
        // je récupère la nouvelle recette
        $newRecipe = $recipesRepository->find($arrayRequest['recipeId']);

        //je modifie l'id de la recette choisi
        $lunchToChange->removeRecipe($recipeToRemove);
        $lunchToChange->addRecipe($newRecipe);

        $lunchsRepository->add($lunchToChange, true);

        return $this->json([
            "lunch" => $lunchToChange
        ],
        Response::HTTP_OK,
        [],
        [
            "groups" => "edit_lunch"
        ]);
    }

    /**
     * @Route("/api/lunchs/{date}", name="api_lunchs_day", methods={"GET"})
     *
     * @param Request $request
     * @param LunchsRepository $lunchsRepository
     * @return JsonResponse
     */
    public function day($date, LunchsRepository $lunchsRepository): JsonResponse
    {
        $date = new DateTime($date);

        $user = $this->getUser();
        $groups = $user->getGroups();
        $group = $groups[0];

        $today = $lunchsRepository->findByDate($date, $date, $group);

        if(empty($today)) {
            for($i = 0; $i < 2; $i++) {
                $newLunch = new Lunchs();
                $newLunch->setDate($date);
                $today[] = $newLunch;
            }

            $today[0]->setTime("midi");
            $today[1]->setTime("soir");
        }

        if(count($today) === 1) {
            $newLunch = new Lunchs();
            $newLunch->setDate($date);
            $today[] = $newLunch;

            if($today[0]->getTime() === "soir") {
                $today = array_reverse($today);
                $today[0]->setTime("midi");
            }
            else {
                $today[1]->setTime("soir");
            }
        }

        if(count($today) === 2 && $today[0]->getTime() === "soir") {
            $today = array_reverse($today);
        }

        return $this->json(
            $today
        ,
        Response::HTTP_OK,
        [],
        [
            "groups" => "day_lunchs"
        ]);
    }
}
