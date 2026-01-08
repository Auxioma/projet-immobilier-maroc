<?php

namespace App\Controller\Administrator;

use App\Entity\User;
use App\Entity\Agencies;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin_145f952eds882a/users', name: 'admin_users_')]
class UsersController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    #[Route('/profile', name: 'profile')]
    public function profile(): Response
    {
        return $this->render('administrator/users/profile.html.twig');
    }

    #[Route('/account-settings', name: 'account_settings')]
    public function accountSettings(): Response
    {
        return $this->render('administrator/users/user-account-settings.html.twig');
    }

    #[Route('/liste-des-utilisateur', name: 'utilisateur')]
    public function ListingUser(PaginatorInterface $paginator, Request $request): Response
    {
        $allUsers = $this->userRepository->findAll();
        $filteredUsers = array_filter($allUsers, function (User $user) {
            $roles = $user->getRoles();
            return in_array('ROLE_USER', $roles, true)
                && !in_array('ROLE_ADMIN', $roles, true)
                && !in_array('ROLE_AGENCE', $roles, true);
        });

        $administrateurs = $paginator->paginate(
            $filteredUsers,
            $request->query->getInt('page', 1), // page courante
            10 // nombre d'éléments par page
        );

        return $this->render('administrator/apps/contacts.html.twig', [
            'users' => $administrateurs,
            'namePage' => 'Liste des utilisateurs'
        ]);
    }

    #[Route('/liste-des-agence', name: 'agence')]
    public function ListingAdmin(PaginatorInterface $paginator, Request $request): Response
    {
        $allUsers = $this->userRepository->findAll();
        $filteredUsers = array_filter($allUsers, function (User $user) {
            $roles = $user->getRoles();
            return in_array('ROLE_AGENCE', $roles, true);
        });

        $administrateurs = $paginator->paginate(
            $filteredUsers,
            $request->query->getInt('page', 1), // numéro de page
            15 // limite par page
        );

        return $this->render('administrator/apps/contacts.html.twig', [
            'users' => $administrateurs,
            'namePage' => 'Liste des agences'
        ]);
    }

    #[Route('/liste-des-administrateur', name: 'administrateur')]
    public function ListingAdministrateur(PaginatorInterface $paginator, Request $request): Response
    {
        // Récupérer tous les utilisateurs
        $allUsers = $this->userRepository->findAll();

        // Filtrer : ROLE_ADMIN, pas ROLE_SUPER_ADMIN, pas ROLE_AGENCE
        $filteredUsers = array_filter($allUsers, function (User $user) {
            $roles = $user->getRoles();
            return in_array('ROLE_ADMIN', $roles, true)
                && !in_array('ROLE_SUPER_ADMIN', $roles, true)
                && !in_array('ROLE_AGENCE', $roles, true);
        });

        // Paginer les résultats filtrés
        $administrateurs = $paginator->paginate(
            $filteredUsers,
            $request->query->getInt('page', 1), // page courante
            10 // nombre d'éléments par page
        );

        return $this->render('administrator/apps/contacts.html.twig', [
            'users' => $administrateurs,
            'namePage' => 'Liste des administrateurs'
        ]);
    }

    #[Route('/api/update/{id}', name: 'update_user', methods: ['POST'])]
    public function updateUser(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository, int $id): JsonResponse
    {
        $user = $userRepository->find($id);
        if (!$user) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'Utilisateur non trouvé',
            ], 404);
        }

        // Décoder le JSON envoyé
        $data = json_decode($request->getContent(), true);
        if (!$data) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'JSON invalide',
            ], 400);
        }

        $user->setEmail($data['email'] ?? $user->getEmail());
        $agency = $user->getAgencies();

        if (!$agency) {
            $agency = new Agencies();
            $user->setAgencies($agency);
        }
        $agency->setName($data['name'] ?? $user->setName());
        $agency->setName($data['name'] ?? $user->setName());

        $entityManager->flush();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Utilisateur mis à jour',
            'user' => [
                'id' => $user->getId(),
                'email' => $user->getEmail() ?? 'N/A',

            ],
        ]);
    }
}
