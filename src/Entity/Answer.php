<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 *
 * @ORM\Entity
 */
class Answer
{
    use TimestampableEntity;
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
     * @ORM\Column(type="string", name="content")
     */
    private $content;

    /**
     * This token allow to group answer arrived by the same payload
     *
     * @var string
     *
     * @ORM\Column(type="string", name="group_by_token")
     */
    private $groupByToken;

    /**
     * @var Question
     *
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="anwsers")
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
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return Answer
     */
    public function setContent(string $content): Answer
    {
        $this->content = $content;

        return $this;
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
     * @return Answer
     */
    public function setQuestion(Question $question): Answer
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return string
     */
    public function getGroupByToken(): string
    {
        return $this->groupByToken;
    }

    /**
     * @param string $groupByToken
     *
     * @return Answer
     */
    public function setGroupByToken(string $groupByToken): Answer
    {
        $this->groupByToken = $groupByToken;

        return $this;
    }
}
