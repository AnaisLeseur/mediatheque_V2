<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home(UserRepository $userRepo): Response
    {
        //$book 
        return $this->render('user/index.html.twig');
    }
    /**
     * @Route("/my_account", name="my_account")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
