<?php

namespace App\Controller\Admin;

use App\Image\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;


class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('tire'),
            TextField::new('name')->onlyWhenCreating(),
            ImageField::new('imageFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
            TextField::new('slug','Path')
                ->onlyOnIndex(),
            ImageField::new('source', 'Image')
                ->onlyOnIndex()
                ->setBasePath('/images/shop')

        ];
    }
}
