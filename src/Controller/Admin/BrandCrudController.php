<?php

namespace App\Controller\Admin;

use App\Brand\Entity\Brand;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BrandCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Brand::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
