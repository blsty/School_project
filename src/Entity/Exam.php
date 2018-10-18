<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamRepository")
 */
class Exam
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="exams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subject;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="exams")
     */
    private $user;

    /**
     * @ORM\Column(type="boolean")
     */
    private $forAll;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Question")
     */
    protected $questions;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }

    public function getForAll(): ?bool
    {
        return $this->forAll;
    }

    public function setForAll(bool $forAll): self
    {
        $this->forAll = $forAll;

        return $this;
    }

    /**
     * @return Collection|question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            #$question->setExam($this);
        }

        return $this;
    }

    public function removeExamQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            /*if ($question->getExam() === $this) {
                $question->setExam(null);
            }*/
        }

        return $this;
    }
}
