<?php

namespace App\Controller\Admin;

use App\Tire\Entity\Tire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tire::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Модель'),
            AssociationField::new('brand')->setLabel('Бренд'),
            AssociationField::new('category')->setLabel('Тип'),
            ChoiceField::new('season')->setLabel('Сезон')->setChoices(array_flip(Tire::SEASONS_LABELS)),
            ChoiceField::new('sealingMethod')->setLabel('Герметизация')->setChoices(array_flip(Tire::SEALING_METHOD_LABELS)),
            ChoiceField::new('studs')->setLabel('Шиповка')->setChoices(array_flip(Tire::STUDS_LABELS)),
            IntegerField::new('width')->setLabel('Ширина'),
            IntegerField::new('height')->setLabel('Высота'),
            IntegerField::new('diameter')->setLabel('Диаметр'),
            IntegerField::new('speedIndex')->setLabel('Скорость'),
            IntegerField::new('loadIndex')->setLabel('Нагрузка'),
            IntegerField::new('marketLaunchDate')->setLabel('Дата'),
            IntegerField::new('quantity')->setLabel('Наличие'),
            NumberField::new('price')->setLabel('Цена'),
            NumberField::new('rating')->setLabel('Рейтинг'),
            NumberField::new('discount')->setLabel('Скидка'),
            BooleanField::new('enabled')->setLabel('Показать'),
            ArrayField::new('images')->setLabel('Images')->hideOnForm(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(CRUD::PAGE_INDEX, 'detail');
    }
}
