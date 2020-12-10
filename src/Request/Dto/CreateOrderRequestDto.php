<?php

namespace App\Request\Dto;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class CreateOrderRequestDto
{
    /**
     * @Assert\NotBlank(message="Введите имя")
     * @Assert\Length(minMessage="Имя должно быть больше 5 символов", maxMessage="Имя должно быть меньше 30 символов", min="5", max="30")
     *
     * @var string
     */
    public $firstName;

    /**
     * @Assert\NotBlank(message="Введите Фамилию")
     * @Assert\Length(minMessage="Фамилия должна быть больше 5 символов", maxMessage="Фамилия должна быть меньше 30 символов", min="5", max="30")
     *
     * @var string
     */
    public $lastName;

    /**
     * @Assert\NotBlank(message="Введите Адрес")
     * @Assert\Length(minMessage="Адрес должен быть больше 5 символов", maxMessage="Адрес должен быть меньше 255 символов", min="5", max="255")
     *
     * @var string
     */
    public $address;

    /**
     * @Assert\NotBlank(message="Введите Телефон")
     * @Assert\Length(minMessage="Телефон должен быть больше 5 символов", maxMessage="Телефон должен быть меньше 30 символов", min="5", max="30")
     *
     * @var string
     */
    public $phone;

    /**
     * @Assert\Length(maxMessage="Имя должно быть меньше 500 символов", max="500")
     *
     * @var string
     */
    public $noteOfOrder;

    /**
     * @Assert\NotBlank(message="Введите почтовый индекс")
     * @Assert\Length(minMessage="Индекс должен быть больше 5 символов", maxMessage="Индекс должен быть меньше 15 символов", min="5", max="15")
     *
     * @var string
     */
    public $postalCode;

    /**
     * @Assert\NotBlank(message="Некоректные данные о способе оплаты")
     * @Assert\Length(minMessage="Некоректные данные о способе оплаты", maxMessage="Некоректные данные о способе оплаты", min="3", max="5")
     *
     * @var integer
     */
    public $paymentMethod;

    /**
     * @Assert\NotBlank(message="Некоректные данные о доставке")
     * @Assert\Length(minMessage="Некоректные данные о доставке", maxMessage="Некоректные данные о доставке", min="5", max="16")
     *
     * @var integer
     */
    public $deliveryMethod;

    public ConstraintViolationListInterface $constraintViolations;
}