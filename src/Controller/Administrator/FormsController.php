<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/forms', name: 'admin_forms_')]
class FormsController extends AbstractController
{
    #[Route('/basic', name: 'basic')]
    public function basic(): Response
    {
        return $this->render('administrator/forms/basic.html.twig');
    }

    #[Route('/input-group', name: 'input_group')]
    public function inputGroup(): Response
    {
        return $this->render('administrator/forms/input-group.html.twig');
    }

    #[Route('/layouts', name: 'layouts')]
    public function layouts(): Response
    {
        return $this->render('administrator/forms/layouts.html.twig');
    }

    #[Route('/validation', name: 'validation')]
    public function validation(): Response
    {
        return $this->render('administrator/forms/validation.html.twig');
    }

    #[Route('/input-mask', name: 'input_mask')]
    public function inputMask(): Response
    {
        return $this->render('administrator/forms/input-mask.html.twig');
    }

    #[Route('/checkbox-radio', name: 'checkbox_radio')]
    public function checkboxRadio(): Response
    {
        return $this->render('administrator/forms/checkbox-radio.html.twig');
    }

    #[Route('/select2', name: 'select2')]
    public function select2(): Response
    {
        return $this->render('administrator/forms/select2.html.twig');
    }

    #[Route('/switches', name: 'switches')]
    public function switches(): Response
    {
        return $this->render('administrator/forms/switches.html.twig');
    }

    #[Route('/wizards', name: 'wizards')]
    public function wizards(): Response
    {
        return $this->render('administrator/forms/wizards.html.twig');
    }

    #[Route('/file-upload', name: 'file_upload')]
    public function fileUpload(): Response
    {
        return $this->render('administrator/forms/file-upload.html.twig');
    }

    #[Route('/quill-editor', name: 'quill_editor')]
    public function quillEditor(): Response
    {
        return $this->render('administrator/forms/quill-editor.html.twig');
    }

    #[Route('/markdown-editor', name: 'markdown_editor')]
    public function markdownEditor(): Response
    {
        return $this->render('administrator/forms/markdown-editor.html.twig');
    }

    #[Route('/date-picker', name: 'date_picker')]
    public function datePicker(): Response
    {
        return $this->render('administrator/forms/date-picker.html.twig');
    }

    #[Route('/clipboard', name: 'clipboard')]
    public function clipboard(): Response
    {
        return $this->render('administrator/forms/clipboard.html.twig');
    }

    #[Route('/touchspin', name: 'touchspin')]
    public function touchspin(): Response
    {
        return $this->render('administrator/forms/touchspin.html.twig');
    }
}
