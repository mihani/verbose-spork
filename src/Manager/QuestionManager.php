<?php

namespace App\Manager;


use App\Entity\Question;
use App\Traits\EntityManagerInterfaceTrait;

class QuestionManager
{
    use EntityManagerInterfaceTrait;

    public function createQuestion(array $formQuestions)
    {
        $questionRepository = $this->em->getRepository(Question::class);

    }
}
