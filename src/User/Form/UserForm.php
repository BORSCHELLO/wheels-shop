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
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Логин',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 5,
                        'max' => 25,
                        'maxMessage' => 'Слишком длинный Логин. Должно быть менее 25 символов. ',
                        'minMessage' => 'Слишком короткий Логин. Должно быть более 5 символов. '
                    ])
                ]
            ])
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class, ['label' => 'Пароль'])
            ->add('firstName', TextType::class, [
                'label' => 'Имя',
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 50,
                        'maxMessage' => 'Слишком длинное Имя. Должно быть менее 50 символов. ',
                        'minMessage' => 'Слишком короткое Имя. Должно быть более 5 символов. '
                    ])
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Фамилия',
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 50,
                        'maxMessage' => 'Слишком длинная Фамилия. Должно быть менее 50 символов. ',
                        'minMessage' => 'Слишком короткая Фамилия. Должно быть более 5 символов. '
                    ])
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Адрес',
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 100,
                        'maxMessage' => 'Слишком длинный Адрес. Должно быть менее 100 символов. ',
                        'minMessage' => 'Слишком короткий Адрес. Должно быть более 5 символов. '
                    ])
                ]
            ])
            ->add('postalCode', NumberType::class, [
                'label' => 'Почтовый индекс',
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 25,
                        'maxMessage' => 'Слишком длинный Почтовый индекс. Должно быть менее 25 символов. ',
                        'minMessage' => 'Слишком короткий Почтовый индекс. Должно быть более 5 символов. '
                    ])
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Телефон',
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 30,
                        'maxMessage' => 'Слишком длинный Телефон. Должно быть менее 30 символов. ',
                        'minMessage' => 'Слишком короткий Телефон. Должно быть более 5 символов. '
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}