<?php

namespace App\Entity;

use App\Traits\Entity\TypeformIdEntityTrait;
use App\Traits\Entity\TypeformRefEntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 *
 * @ORM\Entity
 */
class Question
{
    use SoftDeleteableEntity;
    use TypeformIdEntityTrait;
    use TypeformRefEntityTrait;

    public const MULTIPLE_CHOICE_TYPE = 'multiple_choice';

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
     * @var Form
     *
     * @ORM\ManyToOne(targetEntity="Form", inversedBy="questions")
     * @ORM\JoinColumn(name="form_id", referencedColumnName="id")
     */
    private $form;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     */
    private $anwsers;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", name="allow_other_choice")
     */
    private $allowOtherChoice = false;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="type")
     */
    private $type;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="QuestionChoice", mappedBy="question")
     */
    private $questionChoices;

    public function __construct()
    {
        $this->anwsers = new ArrayCollection();
        $this->questionChoices = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): Question
    {
        $this->label = $label;

        return $this;
    }

    public function getForm(): Form
    {
        return $this->form;
    }

    public function setForm(Form $form): Question
    {
        $this->form = $form;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAnwsers(): Collection
    {
        return $this->anwsers;
    }

    public function setAnwsers(ArrayCollection $anwsers): Question
    {
        $this->anwsers = $anwsers;

        return $this;
    }

    public function addAnwser(Answer $answer): ArrayCollection
    {
        if (!$this->anwsers->contains($answer)) {
            $this->anwsers->add($answer);
        }

        return $this->anwsers;
    }

    public function removeAnswer(Answer $answer): ArrayCollection
    {
        if ($this->anwsers->contains($answer)) {
            $this->anwsers->removeElement($answer);
        }

        return $this->anwsers;
    }

    public function isAllowOtherChoice(): bool
    {
        return $this->allowOtherChoice;
    }

    public function setAllowOtherChoice(bool $allowOtherChoice): Question
    {
        $this->allowOtherChoice = $allowOtherChoice;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): Question
    {
        $this->type = $type;

        return $this;
    }

    public function getQuestionChoices(): ArrayCollection
    {
        return $this->questionChoices;
    }

    public function setQuestionChoices(ArrayCollection $questionChoices): Question
    {
        $this->questionChoices = $questionChoices;

        return $this;
    }

    public function addQuestionChoice(QuestionChoice $questionChoice): ArrayCollection
    {
        if (!$this->questionChoices->contains($questionChoice)) {
            $this->questionChoices->add($questionChoice);
        }

        return $this->questionChoices;
    }

    public function removeQuestionChoice(QuestionChoice $questionChoice): ArrayCollection
    {
        if ($this->questionChoices->contains($questionChoice)) {
            $this->questionChoices->removeElement($questionChoice);
        }

        return $this->questionChoices;
    }
}
