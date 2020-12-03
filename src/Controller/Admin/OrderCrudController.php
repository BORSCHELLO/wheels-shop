<?php

namespace App\Controller\Admin;

use App\Order\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user')->setLabel('Пользователь'),
            TextField::new('firstName')->setLabel('Имя'),
            TextField::new('lastName')->setLabel('Фамилия'),
            TextField::new('address')->setLabel('Адрес'),
            ArrayField::new('orderItems')->setLabel('Товары')->hideOnIndex(),
            TelephoneField::new('phone')->setLabel('Телефон'),
            NumberField::new('postalCode')->setLabel('Индекс'),
            TextField::new('paymentMethod')->setLabel('Способ оплаты'),
            TextField::new('deliveryMethod')->setLabel('Способ доставки'),
            TextField::new('noteOfOrder')->setLabel('Примечание'),
            DateTimeField::new('createdAt')->setLabel('Дата заказа'),
            NumberField::new('totalCost')->setLabel('Стоимость заказа'),
            ChoiceField::new('status')->setLabel('Статус')->setChoices(array_flip(Order::STATUS_LABELS)),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(CRUD::PAGE_INDEX, 'detail');
    }
}
