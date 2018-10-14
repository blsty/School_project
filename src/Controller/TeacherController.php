<?php

namespace App\Controller;

use App\Entity\Answer;
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
        $entityManager = $this->getDoctrine()->getManager();
        $question =  $this->getDoctrine()->getRepository(Question::class)->find($id);
       $repo= $this->getDoctrine()->getRepository(Answer::class);
       $answer = $repo->findBy(["question"=>$question->getId()]);

        return $this->render("teacher/create_answer.html.twig",
            ["question"=>$question->getQuestion(),'id'=>$id, "answers" =>$answer]);

    }

    /**
     * @param $id
     * @return Response
     */
    public function formanswer($id){
       $entityManager = $this->getDoctrine()->getManager();
        $request = Request::createFromGlobals()->request;
        $answer = $request->get('answer');
        $iscorrect = $request->get('iscorrect');


        if ($iscorrect =='on')
            $iscorrect =true;
        else
        $iscorrect= false;

       $answerr = new Answer();
       $answerr ->setAnswer($answer);
       $answerr ->setIsCorrect($iscorrect);
       $answerr ->setQuestion($this->getDoctrine()->
       getRepository(Question::class)->find($id));

       $entityManager->persist($answerr);
       $entityManager->flush();

       $answer = $entityManager->getRepository(Answer::class)->findAll();

        return $this->redirectToRoute('create_answer',
            ["id" => $id,"question"=>$answerr->getQuestion()->getQuestion(),"answers"=> $answer]);
    }

    public function create_exam(){

        return $this->render("teacher/create_exam.html.twig");

    }



public function subject($id){

    $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
    $questions = $this->getDoctrine()->getRepository(Subject::class)->find($id);

    return $this->render("teacher/subject.html.twig",
        ["subject"=>$subject, "questions"=>$questions->getQuestions()]);
}
}