<?php

namespace App\Entity;

use App\Traits\Entity\TypeformIdEntityTrait;
use App\Traits\Entity\TypeformRefEntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

/**
 * @ORM\Entity()
 */
class Question
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
     * @var boolean
     *
     * @ORM\Column(type="boolean", name="multiple_choice")
     */
    private $multipleChoice = false;

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
     * @param string $label
     *
     * @return Question
     */
    public function setLabel(string $label): Question
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }

    /**
     * @param Form $form
     *
     * @return Question
     */
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

    /**
     * @param ArrayCollection $anwsers
     *
     * @return Question
     */
    public function setAnwsers(ArrayCollection $anwsers): Question
    {
        $this->anwsers = $anwsers;

        return $this;
    }

    /**
     * @param Answer $answer
     *
     * @return ArrayCollection
     */
    public function addAnwser(Answer $answer): ArrayCollection
    {
        if (!$this->anwsers->contains($answer)) {
            $this->anwsers->add($answer);
        }

        return $this->anwsers;
    }

    /**
     * @param Answer $answer
     *
     * @return ArrayCollection
     */
    public function removeAnswer(Answer $answer): ArrayCollection
    {
        if ($this->anwsers->contains($answer)) {
            $this->anwsers->removeElement($answer);
        }

        return $this->anwsers;
    }

    /**
     * @return bool
     */
    public function isMultipleChoice(): bool
    {
        return $this->multipleChoice;
    }

    /**
     * @param bool $multipleChoice
     *
     * @return Question
     */
    public function setMultipleChoice(bool $multipleChoice): Question
    {
        $this->multipleChoice = $multipleChoice;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Question
     */
    public function setType(string $type): Question
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getQuestionChoices(): ArrayCollection
    {
        return $this->questionChoices;
    }

    /**
     * @param ArrayCollection $questionChoices
     *
     * @return Question
     */
    public function setQuestionChoices(ArrayCollection $questionChoices): Question
    {
        $this->questionChoices = $questionChoices;

        return $this;
    }

    /**
     * @param QuestionChoice $questionChoice
     *
     * @return ArrayCollection
     */
    public function addQuestionChoice(QuestionChoice $questionChoice): ArrayCollection
    {
        if (!$this->questionChoices->contains($questionChoice)) {
            $this->questionChoices->add($questionChoice);
        }

        return $this->questionChoices;
    }

    /**
     * @param QuestionChoice $questionChoice
     *
     * @return ArrayCollection
     */
    public function removeQuestionChoice(QuestionChoice $questionChoice): ArrayCollection
    {
        if ($this->questionChoices->contains($questionChoice)) {
            $this->questionChoices->removeElement($questionChoice);
        }

        return $this->questionChoices;
    }
}
