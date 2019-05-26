<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

/**
 * @ORM\Entity()
 */
class Question
{
    use SoftDeleteableEntity;

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

    public function __construct()
    {
        $this->anwsers = new ArrayCollection();
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
    public function getAnwsers(): ArrayCollection
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
}