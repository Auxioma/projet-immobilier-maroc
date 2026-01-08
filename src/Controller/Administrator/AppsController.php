<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/apps', name: 'admin_apps_')]
class AppsController extends AbstractController
{
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
