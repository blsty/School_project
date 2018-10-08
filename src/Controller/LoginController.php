<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{

    public function index()
    {
        $user = $this->getUser();

        if( $user->getIsTeacher() == 1 )
            return $this->redirectToRoute('teacher');

            return $this->redirectToRoute('student');
    }

    public function login(AuthenticationUtils $authenticationUtils)
    {
        return $this->render('login/login.html.twig');
    }
}
