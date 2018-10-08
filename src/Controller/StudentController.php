<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{

    public function index()
    {
        return $this->render('studnet/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
}
