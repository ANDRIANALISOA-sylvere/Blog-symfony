<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserHomePageController extends AbstractController
{
    #[Route('/home', name: 'app_user_home_page')]
    public function index(): Response
    {
        return $this->render('user_home_page/index.html.twig', [
            'controller_name' => 'UserHomePageController',
        ]);
    }
}