<?php

namespace App\Factory;

use App\Entity\Question;
use App\Entity\QuestionChoice;

class QuestionChoiceFactory
{
    public static function create(array $choice, Question $question)
    {
        return (new QuestionChoice())
            ->setTypeformId($choice['id'])
            ->setLabel($choice['label'])
            ->setQuestion($question)
        ;
    }
}
