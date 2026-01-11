<?php

namespace App\Controller\Administrator;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin_145f952eds882a/apps', name: 'admin_apps_')]
class AppsController extends AbstractController
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository
    ){}

    #[Route('/categories', name: 'categories')]
    public function categories(): Response
    {
        return $this->render('administrator/apps/categories.html.twig', [
            'categories' => $this->categoryRepository->findBy(['parent' => null]),
            'namePage' => 'Categories'
        ]);
    }

    #[Route('/api/categories/update', name: 'api_categories_update')]
    public function updateCategories(Request $request, EntityManagerInterface $em): JsonResponse 
    {
        $data = json_decode($request->getContent(), true);
      
        if (!$data) {
            return new JsonResponse(['status' => 'error', 'message' => 'Invalid JSON'], 400);
        }

        if (empty($data['name'])) {
            return new JsonResponse(['status' => 'error', 'message' => 'Name is required'], 400);
        }

        if (!empty($data['id'])) {
            $category = $this->categoryRepository->find($data['id']);
            if (!$category) {
                return new JsonResponse(['status' => 'error', 'message' => 'Category not found'], 404);
            }
        } else {
            $category = new Category();
        }

        $category->setName($data['name']);
        $category->setSlug($data['slug']);        
      
        if (!empty($data['parentId'])) {
            $parent = $this->categoryRepository->find($data['parentId']);
            $category->setParent($parent);
        } else {
            $category->setParent(null);
        }

        $em->persist($category);
        $em->flush();

        return new JsonResponse([
            'status' => 'success',
            'category' => [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'slug' => $category->getSlug(),
                'parentId' => $category->getParent()?->getId(),
            ]
        ]);
    }

    #[Route('/chat', name: 'chat')]
    public function chat(): Response
    {
        return $this->render('administrator/apps/chat.html.twig');
    }

    #[Route('/mailbox', name: 'mailbox')]
    public function mailbox(): Response
    {
        return $this->render('administrator/apps/mailbox.html.twig');
    }

    #[Route('/todolist', name: 'todo_list')]
    public function todoList(): Response
    {
        return $this->render('administrator/apps/todolist.html.twig');
    }

    #[Route('/notes', name: 'notes')]
    public function notes(): Response
    {
        return $this->render('administrator/apps/notes.html.twig');
    }

    #[Route('/scrumboard', name: 'scrumboard')]
    public function scrumboard(): Response
    {
        return $this->render('administrator/apps/scrumboard.html.twig');
    }

    #[Route('/contacts', name: 'contacts')]
    public function contacts(): Response
    {
        return $this->render('administrator/apps/contacts.html.twig');
    }

    #[Route('/invoice/list', name: 'invoice_list')]
    public function invoiceList(): Response
    {
        return $this->render('administrator/apps/invoice/list.html.twig');
    }

    #[Route('/invoice/add', name: 'invoice_add')]
    public function invoiceAdd(): Response
    {
        return $this->render('administrator/apps/invoice/add.html.twig');
    }

    #[Route('/invoice/preview', name: 'invoice_preview')]
    public function invoicePreview(): Response
    {
        return $this->render('administrator/apps/invoice/preview.html.twig');
    }

    #[Route('/invoice/edit', name: 'invoice_edit')]
    public function invoiceEdit(): Response
    {
        return $this->render('administrator/apps/invoice/edit.html.twig');
    }

    #[Route('/calendar', name: 'calendar')]
    public function calendar(): Response
    {
        return $this->render('administrator/apps/calendar.html.twig');
    }
}
