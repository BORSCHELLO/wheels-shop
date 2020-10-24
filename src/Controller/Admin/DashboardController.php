<?php

namespace App\Controller\Admin;

use App\Brand\Entity\Brand;
use App\Category\Entity\Category;
use App\Design\Entity\Design;
use App\Image\Entity\Image;
use App\Order\Entity\Order;
use App\Sealing\Entity\Sealing;
use App\Season\Entity\Season;
use App\Thorns\Entity\Thorns;
use App\Tire\Entity\Tire;
use App\User\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(CategoryCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Html');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class),
            MenuItem::linkToCrud('Images', 'fa fa-picture-o', Image::class),
            MenuItem::linkToCrud('Tires', 'fa fa-gear', Tire::class),
            MenuItem::linkToCrud('Orders', 'fa fa-money', Order::class),
            MenuItem::linkToCrud('Users', 'fa fa-user', User::class),
            MenuItem::linkToCrud('Brands', 'fa fa-archive', Brand::class),
        ];
    }
}
