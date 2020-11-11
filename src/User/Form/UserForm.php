<?php

declare(strict_types=1);

namespace App\User\Form;

use App\User\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Логин'])
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class, ['label' => 'Пароль'])
            ->add('firstName', TextType::class, ['label' => 'Имя'])
            ->add('lastName', TextType::class, ['label' => 'Фамилия'])
            ->add('address', TextType::class, ['label' => 'Адрес'])
            ->add('postalCode', NumberType::class, ['label' => 'Почтовый индекс'])
            ->add('phone', TelType::class, ['label' => 'Телефон']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}