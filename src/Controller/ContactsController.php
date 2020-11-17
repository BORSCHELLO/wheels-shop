<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactsController extends AbstractController
{
    /**
     *@Route("/contacts", name="contacts")
     */
    public function contacts()
    {
        return $this->render('contacts.html.twig');
    }
}
