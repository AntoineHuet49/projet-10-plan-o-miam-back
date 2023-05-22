<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Expr\Value;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use ProxyManager\Factory\RemoteObject\Adapter\JsonRpc;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{   
    /**
     * @Route("/api/subscribe", name="api_user_subscribe", methods={"POST"})
     * 
     * Route pour l'inscription des utilisateur
     *
     * @param Request $request
     * @param SerializerInterface $serializerInterface
     * @param UserRepository $userRepository
     * @param UserPasswordHasherInterface $userPasswordHasherInterface
     * 
     * @return JsonResponse
     */
    public function subscribe(Request $request, 
    SerializerInterface $serializerInterface, 
    UserRepository $userRepository, 
    UserPasswordHasherInterface $userPasswordHasherInterface
    ): JsonResponse
    {
        // creation d'un nouvel utilisateur
        $newUser = new User();
        $body = $request->getContent();
        
        // vérification des données envoyé
        $arrayBody = $request->toArray();
        
        // que le passord corresponde au passwordVerification
        if($arrayBody["password"] === $arrayBody["passwordVerification"]) {

            // que tout les champs soit remplie
            foreach($arrayBody as $key => $value) {
                if(empty($arrayBody[$key])) {
                    return $this->json([
                        "error" => "Un ou plusieur champs n'est pas remplie"
                    ],
                    Response::HTTP_BAD_REQUEST
                    );
                }
            }

                
                // ajout des donné dans le nouvel utilisateur
                $newUser = $serializerInterface->deserialize($body, User::class, 'json');

                // hash le password
                $password = $newUser->getPassword();
                $hashedPassword = $userPasswordHasherInterface->hashPassword($newUser ,$password);
                $newUser->setPassword($hashedPassword);
                
                // ajout le role manager pour les compte principaux
                $newUser->setRoles(['ROLE_MANAGER']);

                try {
                    $userRepository->add($newUser, true);
                } 
                catch (Exception $e) {
                    return $this->json([
                        "error" => "Ce nom d'utilisateur est deja pris"
                    ],
                    Response::HTTP_BAD_REQUEST);
                }

                return $this->json([
                    'user' => $newUser,
                ],
                Response::HTTP_OK,
                [],
                [
                    "groups" => "user_subscribe"
                ]
                );
        }

        return $this->json([
            "error" => "Les Mot de passe ne correspondent pas"
        ],
        Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * @Route("/api/users", name="api_user_add", methods={"POST"})
     * 
     * Route pour l'inscription des utilisateur secondaire
     *
     * @param Request $request
     * @param SerializerInterface $serializerInterface
     * @param UserRepository $userRepository
     * @param UserPasswordHasherInterface $userPasswordHasherInterface
     * 
     * @return JsonResponse
     */
    public function add(Request $request, 
    SerializerInterface $serializerInterface, 
    UserRepository $userRepository, 
    UserPasswordHasherInterface $userPasswordHasherInterface
    ): JsonResponse
    {
        // creation d'un nouvel utilisateur
        $newUser = new User();
        $body = $request->getContent();
        
        // vérification des données envoyé
        $arrayBody = $request->toArray();
        
        if(empty($arrayBody["password"]) || empty($arrayBody["passwordVerification"]) || empty($arrayBody["username"])) {
            return $this->json([
                "error" => "Un ou plusieur champs n'est pas remplie"
            ],
            Response::HTTP_BAD_REQUEST
            );
        }

        // que le passord corresponde au passwordVerification
        if($arrayBody["password"] === $arrayBody["passwordVerification"]) {

            // ajouté au groupe de l'utilisateur courrant
            $userPrincipal = $this->getUser();
            $groups = $userPrincipal->getGroups();

            $group = null;

            foreach ($groups as $group) {
                $group = $group;
            }

            if($group === null) {
                return $this->json([
                    "error" => "Vous n'avez pas de tablée"
                ],
                Response::HTTP_NOT_FOUND
                );
            }
            
            // ajout des donné dans le nouvel utilisateur
            $newUser = $serializerInterface->deserialize($body, User::class, 'json');
            
            $newUser->addGroup($group);

            // hash le password
            $password = $newUser->getPassword();
            $hashedPassword = $userPasswordHasherInterface->hashPassword($newUser ,$password);
            $newUser->setPassword($hashedPassword);

            try {
                $userRepository->add($newUser, true);
            } 
            catch (Exception $e) {
                return $this->json([
                    "error" => "Ce nom d'utilisateur est deja pris"
                ],
                Response::HTTP_BAD_REQUEST);
            }

            return $this->json([
                'user' => $newUser,
            ],
            Response::HTTP_OK,
            [],
            [
                "groups" => "user_subscribe"
            ]
            );
        }

        return $this->json([
            "error" => "Les Mot de passe ne corresponde pas"
        ],
        Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Envoie des informations pour un utilisateur
     * 
     * @Route("/api/users", name="api_users_read", methods={"GET"})
     * 
     * @return JsonResponse
     */
    public function read(): JsonResponse
    {
        $user = $this->getUser();

        // if($user === null) {
        //     return $this->json([
        //         'error' => "Cet utilisateur n'éxiste pas"
        //     ],
        //     Response::HTTP_NOT_FOUND
        //     );
        // }

        return $this->json([
            "user" => $user
        ],
        Response::HTTP_OK,
        [],
        [
            "groups" => "user_read"
        ]
        );
    }
    
    /**
     * Update user
     * 
     * @Route("/api/users", name="api_users_edit", methods={"PUT","PATCH"})
     *
     * @param Request $request
     * @param SerializerInterface $serializerInterface
     * @param UserPasswordHasherInterface $userPasswordHasherInterface
     * @param UserRepository $userRepository
     * 
     * @return JsonResponse
     */
    public function edit(Request $request, SerializerInterface $serializerInterface, UserPasswordHasherInterface $userPasswordHasherInterface, UserRepository $userRepository): JsonResponse
    {
        // mettre a jour les données d'un user
        $arrayContent = $request->toArray();
        $content = $request->getContent();
        
        $user = $this->getUser();
        
        if(isset($arrayContent["username"]) && $arrayContent["username"] != $user->getUserIdentifier()) {
            return $this->json([
                "error" => "Le nom d'utilisateur ne peut pas etre modifier"
            ],
            Response::HTTP_BAD_REQUEST
            );
        }

        try{
            $user = $serializerInterface->deserialize($content, User::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $user]);
        }
        catch (Exception $e) {
            return $this->json([
                "error" => "La requète n'est pas bonne"
            ],
            Response::HTTP_BAD_REQUEST);
        }

        if (isset($arrayContent["password"])) {
            $password = trim($arrayContent["password"]);
            
            if($password !== "") {
                if($arrayContent["password"] !== $arrayContent["passwordVerification"]) {
                    return $this->json([
                        "error" => "Les mots de passe sont different"
                    ],
                    Response::HTTP_BAD_REQUEST
                    );
                }
                
            $hashedPassword = $userPasswordHasherInterface->hashPassword($user, $password);
            $user->setPassword($hashedPassword);
            }
        
            if($password === "") {
                return $this->json([
                    "error" => "Le mot de passe est vide"
                ],
                Response::HTTP_BAD_REQUEST);
            }
        }


        $userRepository->add($user, true);

        return $this->json([
            'user' => $user
        ],
        Response::HTTP_OK,
        [],
        [
            "groups" => "user_edit"
        ]
        );
    }

    /**
     * Delete one user
     * 
     * @Route("/api/users/{id<\d+>}", name="api_users_delete", methods={"DELETE"})
     *
     * @param integer $id
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function delete(int $id, UserRepository $userRepository): JsonResponse
    {
        $user = $userRepository->find($id);

        if ($user === null) {
            return $this->json([
                "error" => "Cet utilisateur n'existe pas"
            ],
            Response::HTTP_NOT_FOUND
            );
        }

        $currentUser = $this->getUser();

        if ($user->getId() !== $currentUser->getId()) {
            if (in_array("ROLE_MANAGER", $user->getRoles())) {
                return $this->json([
                    "error" => "Vous n'avez pas le droit de supprimer cet utilisateur"
                ],
                Response::HTTP_FORBIDDEN
                );
            }

            $groups = $currentUser->getGroups()->toArray();

            $currentGroup = null;

            //TODO: V2 gestion si il a plusieur groupe
            foreach ($groups as $currentGroup) {
                $currentGroup = $currentGroup;
            }

            if ($currentGroup === null) {
                return $this->json([
                    "error" => "Vous n'avez pas le droit de supprimer cet utilisateur"
                ],
                Response::HTTP_FORBIDDEN
                );
            }

            if(!in_array($currentGroup, $user->getGroups()->toArray())) {
                return $this->json([
                    "error" => "Vous n'avez pas le droit de supprimer cet utilisateur"
                ],
                Response::HTTP_FORBIDDEN
                );
            }
        }

        $userRepository->remove($user, true);

        return $this->json([
            "message" => "L'utilisateur " . $user->getUserIdentifier() . " à bien été supprimé"
        ]);
    }
}
