<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{

    public function teacher()
    {
        return $this->render("teacher/welcome.html.twig");
    }
}
