<?php

namespace App\Controller\Admin;

use App\Sealing\Entity\Sealing;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SealingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sealing::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
