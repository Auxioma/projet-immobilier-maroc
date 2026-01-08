<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin_145f952eds882a/ui', name: 'admin_ui_')]
class UIController extends AbstractController
{
    // ----- UI Components -----
    #[Route('/components/tabs', name: 'components_tabs')]
    public function componentsTabs(): Response
    {
        return $this->render('administrator/ui-components/tabs.html.twig');
    }

    #[Route('/components/accordions', name: 'components_accordions')]
    public function componentsAccordions(): Response
    {
        return $this->render('administrator/ui-components/accordions.html.twig');
    }

    #[Route('/components/modals', name: 'components_modals')]
    public function componentsModals(): Response
    {
        return $this->render('administrator/ui-components/modals.html.twig');
    }

    #[Route('/components/cards', name: 'components_cards')]
    public function componentsCards(): Response
    {
        return $this->render('administrator/ui-components/cards.html.twig');
    }

    #[Route('/components/carousel', name: 'components_carousel')]
    public function componentsCarousel(): Response
    {
        return $this->render('administrator/ui-components/carousel.html.twig');
    }

    #[Route('/components/countdown', name: 'components_countdown')]
    public function componentsCountdown(): Response
    {
        return $this->render('administrator/ui-components/countdown.html.twig');
    }

    #[Route('/components/counter', name: 'components_counter')]
    public function componentsCounter(): Response
    {
        return $this->render('administrator/ui-components/counter.html.twig');
    }

    #[Route('/components/sweetalert', name: 'components_sweetalert')]
    public function componentsSweetAlert(): Response
    {
        return $this->render('administrator/ui-components/sweetalert.html.twig');
    }

    #[Route('/components/timeline', name: 'components_timeline')]
    public function componentsTimeline(): Response
    {
        return $this->render('administrator/ui-components/timeline.html.twig');
    }

    #[Route('/components/notifications', name: 'components_notifications')]
    public function componentsNotifications(): Response
    {
        return $this->render('administrator/ui-components/notifications.html.twig');
    }

    #[Route('/components/media-object', name: 'components_media_object')]
    public function componentsMediaObject(): Response
    {
        return $this->render('administrator/ui-components/media-object.html.twig');
    }

    #[Route('/components/list-group', name: 'components_list_group')]
    public function componentsListGroup(): Response
    {
        return $this->render('administrator/ui-components/list-group.html.twig');
    }

    #[Route('/components/pricing-table', name: 'components_pricing_table')]
    public function componentsPricing(): Response
    {
        return $this->render('administrator/ui-components/pricing-table.html.twig');
    }

    #[Route('/components/lightbox', name: 'components_lightbox')]
    public function componentsLightbox(): Response
    {
        return $this->render('administrator/ui-components/lightbox.html.twig');
    }

    // ----- UI Elements -----
    #[Route('/elements/alerts', name: 'elements_alerts')]
    public function elementsAlerts(): Response
    {
        return $this->render('administrator/elements/alerts.html.twig');
    }

    #[Route('/elements/avatar', name: 'elements_avatar')]
    public function elementsAvatar(): Response
    {
        return $this->render('administrator/elements/avatar.html.twig');
    }

    #[Route('/elements/badges', name: 'elements_badges')]
    public function elementsBadges(): Response
    {
        return $this->render('administrator/elements/badges.html.twig');
    }

    #[Route('/elements/breadcrumbs', name: 'elements_breadcrumbs')]
    public function elementsBreadcrumbs(): Response
    {
        return $this->render('administrator/elements/breadcrumbs.html.twig');
    }

    #[Route('/elements/buttons', name: 'elements_buttons')]
    public function elementsButtons(): Response
    {
        return $this->render('administrator/elements/buttons.html.twig');
    }

    #[Route('/elements/buttons-group', name: 'elements_buttons_group')]
    public function elementsButtonGroup(): Response
    {
        return $this->render('administrator/elements/buttons-group.html.twig');
    }

    #[Route('/elements/color-library', name: 'elements_color_library')]
    public function elementsColorLibrary(): Response
    {
        return $this->render('administrator/elements/color-library.html.twig');
    }

    #[Route('/elements/dropdown', name: 'elements_dropdown')]
    public function elementsDropdown(): Response
    {
        return $this->render('administrator/elements/dropdown.html.twig');
    }

    #[Route('/elements/infobox', name: 'elements_infobox')]
    public function elementsInfobox(): Response
    {
        return $this->render('administrator/elements/infobox.html.twig');
    }

    #[Route('/elements/jumbotron', name: 'elements_jumbotron')]
    public function elementsJumbotron(): Response
    {
        return $this->render('administrator/elements/jumbotron.html.twig');
    }

    #[Route('/elements/loader', name: 'elements_loader')]
    public function elementsLoader(): Response
    {
        return $this->render('administrator/elements/loader.html.twig');
    }

    #[Route('/elements/pagination', name: 'elements_pagination')]
    public function elementsPagination(): Response
    {
        return $this->render('administrator/elements/pagination.html.twig');
    }

    #[Route('/elements/popovers', name: 'elements_popovers')]
    public function elementsPopovers(): Response
    {
        return $this->render('administrator/elements/popovers.html.twig');
    }

    #[Route('/elements/progress-bar', name: 'elements_progress_bar')]
    public function elementsProgressBar(): Response
    {
        return $this->render('administrator/elements/progress-bar.html.twig');
    }

    #[Route('/elements/search', name: 'elements_search')]
    public function elementsSearch(): Response
    {
        return $this->render('administrator/elements/search.html.twig');
    }

    #[Route('/elements/tooltips', name: 'elements_tooltips')]
    public function elementsTooltips(): Response
    {
        return $this->render('administrator/elements/tooltips.html.twig');
    }

    #[Route('/elements/treeview', name: 'elements_treeview')]
    public function elementsTreeview(): Response
    {
        return $this->render('administrator/elements/treeview.html.twig');
    }

    #[Route('/elements/typography', name: 'elements_typography')]
    public function elementsTypography(): Response
    {
        return $this->render('administrator/elements/typography.html.twig');
    }

    // ----- Other UI pages -----
    #[Route('/charts', name: 'charts')]
    public function charts(): Response
    {
        return $this->render('administrator/charts.html.twig');
    }

    #[Route('/widgets', name: 'widgets')]
    public function widgets(): Response
    {
        return $this->render('administrator/widgets.html.twig');
    }

    #[Route('/font-icons', name: 'font_icons')]
    public function fontIcons(): Response
    {
        return $this->render('administrator/font-icons.html.twig');
    }

    #[Route('/drag-and-drop', name: 'drag_and_drop')]
    public function dragAndDrop(): Response
    {
        return $this->render('administrator/dragndrop.html.twig');
    }
}
