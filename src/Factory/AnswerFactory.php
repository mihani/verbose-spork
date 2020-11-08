<?php

namespace App\Factory;

use App\Dto\AnswerDto;
use App\Entity\Answer;
use App\Entity\Question;
use Ramsey\Uuid\UuidInterface;

class AnswerFactory
{
    public static function create(AnswerDto $answerDto, Question $question, UuidInterface $token): Answer
    {
        return (new Answer())
            ->setQuestion($question)
            ->setContent($answerDto->value)
            ->setGroupByToken($token)
        ;
    }
}
