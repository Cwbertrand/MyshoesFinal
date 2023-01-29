<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\AdultSize;
use App\Entity\Command;
use App\Entity\CommandDetail;
use App\Entity\Header;
use App\Entity\OtherCategories;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\ShoesCategory;
use App\Entity\ShoesGender;
use App\Entity\Transporter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('Admin/base.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Myshoes');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('HomePage', 'fa-solid fa-earth-americas', Header::class);
        yield MenuItem::linkToCrud('User', 'fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Command', 'fas fa-shopping-cart', Command::class);
        yield MenuItem::linkToCrud('Command Details', 'fas fa-circle-info', CommandDetail::class);
        yield MenuItem::linkToCrud('Product', 'fa-solid fa-shoe-prints', Product::class);
        yield MenuItem::linkToCrud('Adult sizes', 'fa-solid fa-bell', AdultSize::class);
        yield MenuItem::linkToCrud('Category', 'fa-solid fa-list', ShoesCategory::class);
        yield MenuItem::linkToCrud('Address', 'fa-solid fa-map-location-dot', Address::class);
        yield MenuItem::linkToCrud('Transport Agencies', 'fa-solid fa-truck-fast', Transporter::class);
        yield MenuItem::linkToCrud('Gender Category', 'fa-solid fa-mars-and-venus-burst', ShoesGender::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
