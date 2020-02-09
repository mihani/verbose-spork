<?php

namespace App\Manager;

use App\Entity\Question;
use App\Entity\QuestionChoice;
use App\Traits\EntityManagerInterfaceTrait;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
class QuestionChoiceManager
{
    use EntityManagerInterfaceTrait;

    public function createQuestionChoice(array $formQuestionChoices, Question $question): void
    {
        foreach ($formQuestionChoices as $formQuestionChoice) {
            if (!$this->em->getRepository(QuestionChoice::class)->findOneBy([
                'typeformId' => $formQuestionChoice['id'],
            ])) {
                $this->create($formQuestionChoice, $question);
            }
        }
    }

    private function create(array $formQuestionChoice, Question $question): void
    {
        $this->em->persist((new QuestionChoice())
            ->setTypeformId($formQuestionChoice['id'])
            ->setLabel($formQuestionChoice['label'])
            ->setQuestion($question));

        $this->em->flush();
    }
}
