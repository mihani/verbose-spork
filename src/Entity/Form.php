<?php

namespace App\Entity;

use App\Traits\Entity\TypeformIdEntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 */
class Form
{
    use TimestampableEntity;
    use SoftDeleteableEntity;
    use TypeformIdEntityTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="name")
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Question", mappedBy="form")
     */
    private $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Form
     */
    public function setName(string $name): Form
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    /**
     * @param ArrayCollection $questions
     *
     * @return Form
     */
    public function setQuestions(ArrayCollection $questions): Form
    {
        $this->questions = $questions;

        return $this;
    }

    /**
     * @param Question $question
     *
     * @return ArrayCollection
     */
    public function addQuestion(Question $question): ArrayCollection
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
        }

        return $this->questions;
    }

    /**
     * @param Question $question
     *
     * @return ArrayCollection
     */
    public function removeQuestion(Question $question): ArrayCollection
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
        }

        return $this->questions;
    }
}
