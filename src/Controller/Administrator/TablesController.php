<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin_145f952eds882a/tables', name: 'admin_tables_')]
class TablesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('administrator/tables/index.html.twig');
    }

    #[Route('/datatables/advanced', name: 'datatables_advanced')]
    public function datatablesAdvanced(): Response
    {
        return $this->render('administrator/datatables/advanced.html.twig');
    }

    #[Route('/datatables/alt-pagination', name: 'datatables_alt_pagination')]
    public function datatablesAltPagination(): Response
    {
        return $this->render('administrator/datatables/alt-pagination.html.twig');
    }

    #[Route('/datatables/basic', name: 'datatables_basic')]
    public function datatablesBasic(): Response
    {
        return $this->render('administrator/datatables/basic.html.twig');
    }

    #[Route('/datatables/checkbox', name: 'datatables_checkbox')]
    public function datatablesCheckbox(): Response
    {
        return $this->render('administrator/datatables/checkbox.html.twig');
    }

    #[Route('/datatables/clone-header', name: 'datatables_clone_header')]
    public function datatablesCloneHeader(): Response
    {
        return $this->render('administrator/datatables/clone-header.html.twig');
    }

    #[Route('/datatables/column-chooser', name: 'datatables_column_chooser')]
    public function datatablesColumnChooser(): Response
    {
        return $this->render('administrator/datatables/column-chooser.html.twig');
    }

    #[Route('/datatables/export', name: 'datatables_export')]
    public function datatablesExport(): Response
    {
        return $this->render('administrator/datatables/export.html.twig');
    }

    #[Route('/datatables/multi-column', name: 'datatables_multi_column')]
    public function datatablesMultiColumn(): Response
    {
        return $this->render('administrator/datatables/multi-column.html.twig');
    }

    #[Route('/datatables/multiple-tables', name: 'datatables_multiple_tables')]
    public function datatablesMultipleTables(): Response
    {
        return $this->render('administrator/datatables/multiple-tables.html.twig');
    }

    #[Route('/datatables/order-sorting', name: 'datatables_order_sorting')]
    public function datatablesOrderSorting(): Response
    {
        return $this->render('administrator/datatables/order-sorting.html.twig');
    }

    #[Route('/datatables/range-search', name: 'datatables_range_search')]
    public function datatablesRangeSearch(): Response
    {
        return $this->render('administrator/datatables/range-search.html.twig');
    }

    #[Route('/datatables/skin', name: 'datatables_skin')]
    public function datatablesSkin(): Response
    {
        return $this->render('administrator/datatables/skin.html.twig');
    }

    #[Route('/datatables/sticky-header', name: 'datatables_sticky_header')]
    public function datatablesStickyHeader(): Response
    {
        return $this->render('administrator/datatables/sticky-header.html.twig');
    }
}
