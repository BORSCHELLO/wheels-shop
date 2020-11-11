<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\User\Entity;

use App\Cart\Entity\Cart;
use App\Tests\Unit\TestPrivateHelper;
use App\Tire\Entity\Tire;
use App\User\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testAll()
    {
        $user = new User();
        $helper = new TestPrivateHelper($user);
        $helper->set('id', 1);
        $user->setName('testName')
            ->setEmail('test@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');

        $this->assertEquals(1, $user->getId());
        $this->assertEquals('testName', $user->getName());
        $this->assertEquals('test@mail.ru', $user->getEmail());
        $this->assertEquals('123', $user->getPassword());
        $this->assertEquals('testFirstName', $user->getFirstName());
        $this->assertEquals('testLastName', $user->getLastName());
        $this->assertEquals('testAdress', $user->getAddress());
        $this->assertEquals(1234, $user->getPostalCode());
        $this->assertEquals('12334', $user->getPhone());
    }
}