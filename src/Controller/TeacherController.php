<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{

    public function teacher()
    {
        $id = $this->getUser()->getId();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

     $name = $user->getUsername();

        return $this->render("teacher/welcome.html.twig", ["name" =>$name] );
    }

    public function create_subject(){
        $entityManager = $this->getDoctrine()->getManager();

        return $this->render("teacher/create_subject.html.twig");
    }

}
