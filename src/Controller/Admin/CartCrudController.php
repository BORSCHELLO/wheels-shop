<?php

namespace App\Controller\Admin;

use App\Cart\Entity\Cart;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class CartCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cart::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            NumberField::new('count'),
            AssociationField::new('tire'),
            AssociationField::new('user')
        ];
    }

}
