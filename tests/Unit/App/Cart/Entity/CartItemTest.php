<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Cart\Entity;

use App\Cart\Entity\CartItem;
use App\Tests\Unit\TestPrivateHelper;
use App\Tire\Entity\Tire;
use App\User\Entity\User;
use PHPUnit\Framework\TestCase;

class CartItemTest extends TestCase
{
    public function testAll()
    {
        $cart = new CartItem();
        $tire = new Tire();
        $user = new User();
        $helper = new TestPrivateHelper($cart);

        $helper->set('id', 1);
        $cart->setQuantity(3)
        ->setUser($user)
        ->setTire($tire);



        $this->assertEquals(1, $cart->getId());
        $this->assertEquals(3, $cart->getQuantity());
        $this->assertEquals($user, $cart->getUser());
        $this->assertEquals($tire, $cart->getTire());
    }

    public function testIncreaseQuantity()
    {
        $cart = new CartItem();

        $test1 = $cart->setQuantity(2);
        $result = $test1->increaseQuantity(1);
        $test2 = $cart->setQuantity(3);

        $this->assertEquals($test2, $result);
    }

    public function testDecreaseQuantity()
    {
        $cart = new CartItem();

        $test1 = $cart->setQuantity(2);
        $result = $test1->decreaseQuantity(1);
        $test2 = $cart->setQuantity(1);

        $this->assertEquals($test2, $result);
    }
}