<?php

namespace App\Controller;

use App\Entity\Groups;
use App\Repository\GroupsRepository;
use App\Repository\UserRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\GroupSequence;

class GroupsController extends AbstractController
{
    /**
     * @Route("/api/groups", name="api_groups_read", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function read(): JsonResponse
    {
        // Récupération de l'utilisateur courant
        $user = $this->getUser();

        // Récupération du groupe de l'utilisateur
        $groups = $user->getGroups();
        $group = $groups[0];


        // Si le groupe est null
        if($group === null) {
            // Je retourne une erreur 404
            return $this->json([
                "error" => "Cet utilisateur n'a pas de tablée"
            ],
            Response::HTTP_NOT_FOUND
            );
        }

        // Sinon je retourne les info du groupe
        return $this->json([
            'group' => $group
        ],
        Response::HTTP_OK,
        [],
        [
            "groups" => "groups_read"
        ]
        );
    }

    /**
     * Ajout d'un groupe en base de donnée
     * 
     * @Route("/api/groups", name="api_groups_add", methods={"POST"})
     *
     * @param Request $request
     * @param GroupsRepository $groupsRepository
     * @param UserRepository $userRepository
     * @param SerializerInterface $serializerInterface
     * 
     * @return JsonResponse
     */
    public function add(Request $request, 
    GroupsRepository $groupsRepository, 
    SerializerInterface $serializerInterface): JsonResponse
    {
        // Je récupère les info de la requete et les ajoute dans un nouveau groupe
        $newGroups = $serializerInterface->deserialize($request->getContent(), Groups::class, 'json');

        // je récupère l'utilisateur courant
        $user = $this->getUser();
        
        // Je récupère le groupe de l'utilisateur
        $groups = $user->getGroups();

        // Si l'utilisateur a deja un groupe je renvoie une erreur 405
        if(!$groups->isEmpty()) {
            return $this->json([
                "error" => "Cet utilisateur a deja un groupe"
            ],
            Response::HTTP_METHOD_NOT_ALLOWED
            );
        }

        // sinon je lie l'utilisateur au nouveau groupe
        $newGroups->addUser($user);
        
        // j'ajoute le groupe en BDD
        $groupsRepository->add($newGroups, true);

        return $this->json([
            'message' => "Tablée ajouté"
        ]);
    }

    /**
     * Update d'un groupe en base de donnée
     * 
     * @Route("/api/groups/{id<\d+>}", name="api_groups_edit", methods={"PUT"})
     *
     * @param integer $id
     * @param Request $request
     * @param GroupsRepository $groupsRepository
     * @param SerializerInterface $serializerInterface
     * 
     * @return JsonResponse
     */
    public function edit(int $id, 
    Request $request,
    GroupsRepository $groupsRepository, 
    SerializerInterface $serializerInterface): JsonResponse
    {
        // Je récupère le groupe grâce a son id
        $group = $groupsRepository->find($id);

        // Si le groupe n'existe pas je renvoie une erreur 404
        if($group === null){
            return $this->json([
                "error" => "Ce groupe n'existe pas"
            ],
            Response::HTTP_NOT_FOUND
            );
        }

        // Sinon je récupère le contenue de la requete
        $content = $request->getContent();

        // J'insert le contenue de la requete dans le groupe
        $serializerInterface->deserialize($content, Groups::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $group]);

        // Je sauvegarde les modification dans la base de données
        $groupsRepository->add($group, true);

        return $this->json([
            'group' => $group
        ],
        Response::HTTP_OK,
        [],
        [
            "groups" => "groups_edit"
        ]
        );
    }

    /**
     * @Route("/api/request", name="api_groups_request", methods={"POST"})
     * 
     * ! pas terminé
     *
     * @return JsonResponse
     */
    public function request(MailerInterface $mailerInterface): JsonResponse
    {
        $email = (new Email())
            ->to('likinantoine@gmail.com')
            ->subject('Invitation a plan\'o\'miam')
            ->text('Pour rejoindre votre amie cliqué sur ce lien ...');

            try {
                $mailerInterface->send($email);
            }
            catch (Exception $e) {
                return $this->json([
                    'error' => "Erreur lors de l'envoie"
                ],
                Response::HTTP_SERVICE_UNAVAILABLE    
                );
            }


            return $this->json([
                'message' => 'Invitation bien envoyé'
            ]);
    }

    /**
     * @Route("/api/groups/{id<\d+>}", name="api_groups_addUser", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function addUser(int $id, Request $request, GroupsRepository $groupsRepository, UserRepository $userRepository): JsonResponse
    {
        $group = $groupsRepository->find($id);

        if($group === null) {
            return $this->json([
                "error" => "Ce groupe n'éxiste pas"
            ],
            Response::HTTP_NOT_FOUND
            );
        }

        $content = $request->toArray();
        $username = $content['username'];
        $userToAdd = $userRepository->findOneBy(["username" => $username]);

        if($userToAdd === null) {
            return $this->json([
                "error" => "Cet utilisateur n'existe pas"
            ],
            Response::HTTP_NOT_FOUND
            );
        }

        if(!$userToAdd->getGroups()->isEmpty()) {
            return $this->json([
                "error" => 'Cet utilisateur est déja dans un groupe'
            ],
            Response::HTTP_METHOD_NOT_ALLOWED
            );
        }

        $group->addUser($userToAdd);

        $groupsRepository->add($group, true);

        return $this->json([
            "message" => "utilisateur " . $username . " à bien été ajouté au groupe " . $group->getName()
        ]);
    }

    /**
     * Delete one group and the secondary users relate to this group
     * 
     * @Route("/api/groups/{id<\d+>}", name="api_groups_delete", methods={"DELETE"})
     *
     * @param integer $id
     * @param GroupsRepository $groupsRepository
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function delete(int $id, GroupsRepository $groupsRepository, UserRepository $userRepository): JsonResponse
    {
        // je récupère le groupe
        $group = $groupsRepository->find($id);

        // je verifie que ce groupe existe
        if($group === null) {
            return $this->json([
                "error" => "Ce groupe n'existe pas"
            ],
            Response::HTTP_NOT_FOUND
            );
        }

        // je récupère l'utilisateur courant
        $currentUser = $this->getUser();
        // je récupère le groupe de l'utilisateur courant
        $currentGroups = $currentUser->getGroups()->toArray();

        // je verifie si l'utilisateur fait partie du groupe qu'il veut supprimer
        if(!in_array($group, $currentGroups)) {
            return $this->json([
                "error" => "Vous n'avez pas le droit de supprimer cette tablée"
            ],
            Response::HTTP_FORBIDDEN
            );
        }

        // je récupère tout les utilisateurs du groupe
        $allUser = $group->getUsers();

        // je supprime tout les utilisateur secondaire du groupe
        foreach($allUser as $user) {
            if (!in_array("ROLE_MANAGER", $user->getRoles())) {
                $userRepository->remove($user);
            }
        }

        // je supprime le groupe
        $groupsRepository->remove($group, true);

        return $this->json([
            "message" => "Le groupe " . $group->getName() . " à bien été supprimé"
        ]);
    }
}
