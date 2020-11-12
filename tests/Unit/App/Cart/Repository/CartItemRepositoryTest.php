<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Cart\Repository;

use App\Brand\Entity\Brand;
use App\Brand\Repository\BrandRepositoryInterface;
use App\Cart\Entity\CartItem;
use App\Cart\Repository\CartItemRepositoryInterface;
use App\Category\Entity\Category;
use App\Category\Repository\CategoryRepositoryInterface;
use App\Tests\Unit\DoctrineTestCase;
use App\Tire\Entity\Tire;
use App\Tire\Repository\TireRepositoryInterface;
use App\User\Entity\User;
use App\User\Repository\UserRepositoryInterface;

class CartItemRepositoryTest extends DoctrineTestCase
{
    private CartItemRepositoryInterface $cartItemRepository;

    private UserRepositoryInterface $userRepository;

    private TireRepositoryInterface $tireRepository;

    private BrandRepositoryInterface $brandRepository;

    private CategoryRepositoryInterface $categoryRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->cartItemRepository= $this->em->getRepository(CartItem::class);
        $this->userRepository= $this->em->getRepository(User::class);
        $this->tireRepository= $this->em->getRepository(Tire::class);
        $this->brandRepository= $this->em->getRepository(Brand::class);
        $this->categoryRepository= $this->em->getRepository(Category::class);
    }

    public function testCreate()
    {
        $cart = new CartItem();
        $user = new User();
        $user->setName('testName')
            ->setEmail('test@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');
        $this->userRepository->create($user);
        $tire = new Tire();
        $brand = new Brand();
        $brand->setName('brand');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);
        $category = new Category();
        $category->setName('category');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire->setName('test name');
        $tire->setBrand($brand);
        $tire->setCategory($category);
        $tire->setSealingMethod(Tire::SEALING_METHOD_TUBELESS);
        $tire->setStuds(Tire::STUDS_WITHOUT);
        $tire->setSeason(Tire::SEASON_MEDIUM);
        $tire->setEnabled(true);
        $tire->setDiscount(0);
        $tire->setRating(4.5);
        $tire->setQuantity(5);
        $tire->setPrice(115.5);
        $tire->setLoadIndex(94);
        $tire->setSpeedIndex(210);
        $tire->setDiameter(16);
        $tire->setHeight(55);
        $tire->setWidth(205);
        $tire->setMarketLaunchDate(2020);
        $this->tireRepository->create($tire);
        $cart->setQuantity(1)
        ->setTire($tire)
        ->setUser($user);

        $this->cartItemRepository->create($cart);

        $this->assertEquals(1, $cart->getId());
        $this->assertEquals(1, $cart->getQuantity());
        $this->assertEquals($user, $cart->getUser());
        $this->assertEquals($tire, $cart->getTire());
    }

    public function testFindByUserAndTire()
    {
        $cart1 = new CartItem();
        $user1 = new User();
        $user1->setName('testName1')
            ->setEmail('test@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');
        $this->userRepository->create($user1);
        $tire1 = new Tire();
        $brand = new Brand();
        $brand->setName('brand');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);
        $category = new Category();
        $category->setName('category');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire1->setName('test name1')
        ->setBrand($brand)
        ->setCategory($category)
        ->setSealingMethod(Tire::SEALING_METHOD_TUBELESS)
        ->setStuds(Tire::STUDS_WITHOUT)
        ->setSeason(Tire::SEASON_MEDIUM)
        ->setEnabled(true)
        ->setDiscount(0)
        ->setRating(4.5)
        ->setQuantity(5)
        ->setPrice(115.5)
        ->setLoadIndex(94)
        ->setSpeedIndex(210)
        ->setDiameter(16)
        ->setHeight(55)
        ->setWidth(205)
        ->setMarketLaunchDate(2020);
        $this->tireRepository->create($tire1);
        $cart1->setQuantity(1)
            ->setTire($tire1)
            ->setUser($user1);

        $this->cartItemRepository->create($cart1);

        $cart2 = new CartItem();
        $user2 = new User();
        $user2->setName('testName2')
            ->setEmail('test2@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');
        $this->userRepository->create($user2);
        $tire2 = new Tire();
        $brand = new Brand();
        $brand->setName('brand');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);
        $category = new Category();
        $category->setName('category');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire2->setName('test name2')
            ->setBrand($brand)
            ->setCategory($category)
            ->setSealingMethod(Tire::SEALING_METHOD_TUBELESS)
            ->setStuds(Tire::STUDS_WITHOUT)
            ->setSeason(Tire::SEASON_MEDIUM)
            ->setEnabled(true)
            ->setDiscount(0)
            ->setRating(4.5)
            ->setQuantity(5)
            ->setPrice(115.5)
            ->setLoadIndex(94)
            ->setSpeedIndex(210)
            ->setDiameter(16)
            ->setHeight(55)
            ->setWidth(205)
            ->setMarketLaunchDate(2020);
        $this->tireRepository->create($tire2);
        $cart2->setQuantity(1)
            ->setTire($tire2)
            ->setUser($user2);

        $this->cartItemRepository->create($cart2);

        $result = $this->cartItemRepository->findByUserAndTire($user1, $tire1);
        $this->assertNotEmpty($result);
        $this->assertEquals($user1, $result->getUser());
        $this->assertEquals($tire1, $result->getTire());

        $result1 = $this->cartItemRepository->findByUserAndTire($user2, $tire2);
        $this->assertNotEmpty($result1);
        $this->assertEquals($user2, $result1->getUser());
        $this->assertEquals($tire2, $result1->getTire());
    }

    public function testIncreaseQuantity()
    {
        $cart1 = new CartItem();
        $user1 = new User();
        $user1->setName('testName1')
            ->setEmail('test@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');
        $this->userRepository->create($user1);
        $tire1 = new Tire();
        $brand = new Brand();
        $brand->setName('brand');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);
        $category = new Category();
        $category->setName('category');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire1->setName('test name1')
            ->setBrand($brand)
            ->setCategory($category)
            ->setSealingMethod(Tire::SEALING_METHOD_TUBELESS)
            ->setStuds(Tire::STUDS_WITHOUT)
            ->setSeason(Tire::SEASON_MEDIUM)
            ->setEnabled(true)
            ->setDiscount(0)
            ->setRating(4.5)
            ->setQuantity(5)
            ->setPrice(115.5)
            ->setLoadIndex(94)
            ->setSpeedIndex(210)
            ->setDiameter(16)
            ->setHeight(55)
            ->setWidth(205)
            ->setMarketLaunchDate(2020);
        $this->tireRepository->create($tire1);
        $cart1->setQuantity(1)
            ->setTire($tire1)
            ->setUser($user1);

        $this->cartItemRepository->create($cart1);

        $result=$this->cartItemRepository->increaseQuantity($cart1, 2);
        $this->assertEquals(3,$result->getQuantity());

        $result1=$this->cartItemRepository->increaseQuantity($cart1, 5);
        $this->assertEquals(8,$result1->getQuantity());
    }

    public function testGetItemCollection()
    {
        $cart1 = new CartItem();
        $user1 = new User();
        $user1->setName('testName1')
            ->setEmail('test@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');
        $this->userRepository->create($user1);
        $tire1 = new Tire();
        $brand = new Brand();
        $brand->setName('brand');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);
        $category = new Category();
        $category->setName('category');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire1->setName('test name1')
            ->setBrand($brand)
            ->setCategory($category)
            ->setSealingMethod(Tire::SEALING_METHOD_TUBELESS)
            ->setStuds(Tire::STUDS_WITHOUT)
            ->setSeason(Tire::SEASON_MEDIUM)
            ->setEnabled(true)
            ->setDiscount(0)
            ->setRating(4.5)
            ->setQuantity(5)
            ->setPrice(115.5)
            ->setLoadIndex(94)
            ->setSpeedIndex(210)
            ->setDiameter(16)
            ->setHeight(55)
            ->setWidth(205)
            ->setMarketLaunchDate(2020);
        $this->tireRepository->create($tire1);
        $cart1->setQuantity(1)
            ->setTire($tire1)
            ->setUser($user1);

        $this->cartItemRepository->create($cart1);

        $cart2 = new CartItem();
        $user2 = new User();
        $user2->setName('testName2')
            ->setEmail('test2@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');
        $this->userRepository->create($user2);
        $tire2 = new Tire();
        $brand = new Brand();
        $brand->setName('brand');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);
        $category = new Category();
        $category->setName('category');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire2->setName('test name2')
            ->setBrand($brand)
            ->setCategory($category)
            ->setSealingMethod(Tire::SEALING_METHOD_TUBELESS)
            ->setStuds(Tire::STUDS_WITHOUT)
            ->setSeason(Tire::SEASON_MEDIUM)
            ->setEnabled(true)
            ->setDiscount(0)
            ->setRating(4.5)
            ->setQuantity(5)
            ->setPrice(115.5)
            ->setLoadIndex(94)
            ->setSpeedIndex(210)
            ->setDiameter(16)
            ->setHeight(55)
            ->setWidth(205)
            ->setMarketLaunchDate(2020);
        $this->tireRepository->create($tire2);
        $cart2->setQuantity(1)
            ->setTire($tire2)
            ->setUser($user2);

        $this->cartItemRepository->create($cart2);

        $result = $this->cartItemRepository->getItemCollection($user1);
        $this->assertNotEmpty($result);
        $this->assertEquals($cart1, $result->get(0));

        $result1 = $this->cartItemRepository->getItemCollection($user2);
        $this->assertNotEmpty($result1);
        $this->assertEquals($cart2, $result1->get(0));
    }

    public function testDelete()
    {
        $cart1 = new CartItem();
        $user1 = new User();
        $user1->setName('testName1')
            ->setEmail('test@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');
        $this->userRepository->create($user1);
        $tire1 = new Tire();
        $brand = new Brand();
        $brand->setName('brand');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);
        $category = new Category();
        $category->setName('category');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire1->setName('test name1')
            ->setBrand($brand)
            ->setCategory($category)
            ->setSealingMethod(Tire::SEALING_METHOD_TUBELESS)
            ->setStuds(Tire::STUDS_WITHOUT)
            ->setSeason(Tire::SEASON_MEDIUM)
            ->setEnabled(true)
            ->setDiscount(0)
            ->setRating(4.5)
            ->setQuantity(5)
            ->setPrice(115.5)
            ->setLoadIndex(94)
            ->setSpeedIndex(210)
            ->setDiameter(16)
            ->setHeight(55)
            ->setWidth(205)
            ->setMarketLaunchDate(2020);
        $this->tireRepository->create($tire1);
        $cart1->setQuantity(1)
            ->setTire($tire1)
            ->setUser($user1);

        $this->cartItemRepository->create($cart1);

        $cart2 = new CartItem();
        $user2 = new User();
        $user2->setName('testName2')
            ->setEmail('test2@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');
        $this->userRepository->create($user2);
        $tire2 = new Tire();
        $brand = new Brand();
        $brand->setName('brand');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);
        $category = new Category();
        $category->setName('category');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire2->setName('test name2')
            ->setBrand($brand)
            ->setCategory($category)
            ->setSealingMethod(Tire::SEALING_METHOD_TUBELESS)
            ->setStuds(Tire::STUDS_WITHOUT)
            ->setSeason(Tire::SEASON_MEDIUM)
            ->setEnabled(true)
            ->setDiscount(0)
            ->setRating(4.5)
            ->setQuantity(5)
            ->setPrice(115.5)
            ->setLoadIndex(94)
            ->setSpeedIndex(210)
            ->setDiameter(16)
            ->setHeight(55)
            ->setWidth(205)
            ->setMarketLaunchDate(2020);
        $this->tireRepository->create($tire2);
        $cart2->setQuantity(1)
            ->setTire($tire2)
            ->setUser($user2);

        $this->cartItemRepository->create($cart2);

        $result = $this->cartItemRepository->getItemCollection($user1);
        $this->assertNotEmpty($result);
        $this->assertEquals($cart1, $result->get(0));

        $this->cartItemRepository->delete(1);

        $result1 = $this->cartItemRepository->getItemCollection($user1);
        $this->assertEmpty($result1);

        $result2 = $this->cartItemRepository->getItemCollection($user2);
        $this->assertNotEmpty($result2);
        $this->assertEquals($cart2, $result2->get(0));

        $this->cartItemRepository->delete(2);
        $result3 = $this->cartItemRepository->getItemCollection($user2);
        $this->assertEmpty($result3);
    }

    public function testIncrement()
    {
        $cart1 = new CartItem();
        $user1 = new User();
        $user1->setName('testName1')
            ->setEmail('test@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');
        $this->userRepository->create($user1);
        $tire1 = new Tire();
        $brand = new Brand();
        $brand->setName('brand');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);
        $category = new Category();
        $category->setName('category');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire1->setName('test name1')
            ->setBrand($brand)
            ->setCategory($category)
            ->setSealingMethod(Tire::SEALING_METHOD_TUBELESS)
            ->setStuds(Tire::STUDS_WITHOUT)
            ->setSeason(Tire::SEASON_MEDIUM)
            ->setEnabled(true)
            ->setDiscount(0)
            ->setRating(4.5)
            ->setQuantity(5)
            ->setPrice(115.5)
            ->setLoadIndex(94)
            ->setSpeedIndex(210)
            ->setDiameter(16)
            ->setHeight(55)
            ->setWidth(205)
            ->setMarketLaunchDate(2020);
        $this->tireRepository->create($tire1);
        $cart1->setQuantity(1)
            ->setTire($tire1)
            ->setUser($user1);

        $this->cartItemRepository->create($cart1);


        $result1 = $this->cartItemRepository->increment(1, 1);
        $this->assertNotEmpty($result1);
        $this->assertEquals(2, $result1->getQuantity());

        $result2 = $this->cartItemRepository->increment(1, 4);
        $this->assertNotEmpty($result2);
        $this->assertEquals(6, $result2->getQuantity());
    }

    public function testDecrement()
    {
        $cart1 = new CartItem();
        $user1 = new User();
        $user1->setName('testName1')
            ->setEmail('test@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');
        $this->userRepository->create($user1);
        $tire1 = new Tire();
        $brand = new Brand();
        $brand->setName('brand');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);
        $category = new Category();
        $category->setName('category');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire1->setName('test name1')
            ->setBrand($brand)
            ->setCategory($category)
            ->setSealingMethod(Tire::SEALING_METHOD_TUBELESS)
            ->setStuds(Tire::STUDS_WITHOUT)
            ->setSeason(Tire::SEASON_MEDIUM)
            ->setEnabled(true)
            ->setDiscount(0)
            ->setRating(4.5)
            ->setQuantity(5)
            ->setPrice(115.5)
            ->setLoadIndex(94)
            ->setSpeedIndex(210)
            ->setDiameter(16)
            ->setHeight(55)
            ->setWidth(205)
            ->setMarketLaunchDate(2020);
        $this->tireRepository->create($tire1);
        $cart1->setQuantity(5)
            ->setTire($tire1)
            ->setUser($user1);

        $this->cartItemRepository->create($cart1);

        $result1 = $this->cartItemRepository->decrement(1, 1);
        $this->assertNotEmpty($result1);
        $this->assertSame(4, $result1->getQuantity());

        $result2 = $this->cartItemRepository->decrement(1, 2);
        $this->assertNotEmpty($result2);
        $this->assertSame(2, $result2->getQuantity());
    }
}