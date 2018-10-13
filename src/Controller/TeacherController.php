<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\User;
use App\Entity\Subject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{

    public function teacher()
    {
       # $id = $this->getUser()->getId();
        $user = $this->getUser();
        $subjects = $this->getDoctrine()->getRepository(Subject::class)->findBy(["user"=>$user->getId()]);
        $name = $user->getUsername();

        return $this->render("teacher/welcome.html.twig", ["subjects" => $subjects, "name" => $name]);

      #  return $this->render("teacher/welcome.html.twig", ["name" =>$name] );
    }

    public function create_subject(){
        $entityManager = $this->getDoctrine()->getManager();

        return $this->render("teacher/create_subject.html.twig");
    }

    public function formsubject(){
        $request = Request::createFromGlobals()->request;
        $subject = $request->get('subject');
        $description = $request->get('description');

        $entityManager = $this->getDoctrine()->getManager();
        $sbj = new Subject();
        $sbj->setName($subject);
        $sbj->setDescription($description);
        $sbj->setUser($this->getUser());

        $entityManager->persist($sbj);
        $entityManager->flush();

        return $this->redirectToRoute('teacher');
    }

    public function formquestion(){

        $request = Request::createFromGlobals()->request;
        $question = $request->get('question');
        $id = $request->get('subject_id');
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();

        $questionn = new Question();
        $questionn->setQuestion($question);
        $questionn->setSubject($subject);

        $entityManager->persist($questionn);
        $entityManager->flush();

        return $this->redirectToRoute('create_answer', ['id'=>$questionn->getId()]);

    }


    public function  create_answer($id){
       $question =  $this->getDoctrine()->getRepository(Question::class)->find($id);


        return $this->render("teacher/create_answer.html.twig", ["question"=>$question->getQuestion()]);

    }


    public function create_exam(){

        return $this->render("teacher/create_exam.html.twig");

    }



public function subject($id){

    $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
    $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();
    return $this->render("teacher/subject.html.twig",["subject"=>$subject, "questions"=>$questions]);
}
}