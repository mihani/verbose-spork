<?php

namespace App\Entity;

use App\Traits\Entity\TypeformIdEntityTrait;
use App\Traits\Entity\TypeformRefEntityTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

/**
 * @ORM\Entity()
 */
class QuestionChoice
{
    use SoftDeleteableEntity;
    use TypeformIdEntityTrait;
    use TypeformRefEntityTrait;

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
     * @ORM\Column(type="string", name="label")
     */
    private $label;

    /**
     * @var Question
     *
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="questionChoices")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $question;

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
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return Question
     */
    public function getQuestion(): Question
    {
        return $this->question;
    }

    /**
     * @param Question $question
     *
     * @return QuestionChoice
     */
    public function setQuestion(Question $question): QuestionChoice
    {
        $this->question = $question;

        return $this;
    }
}
