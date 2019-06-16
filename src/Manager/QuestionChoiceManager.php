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

    /**
     * @param array    $formQuestionChoices
     * @param Question $question
     */
    public function createQuestionChoice(array $formQuestionChoices, Question $question)
    {
        foreach ($formQuestionChoices as $formQuestionChoice) {
            if (!$this->em->getRepository(QuestionChoice::class)->findOneBy([
                'typeformRef' => $formQuestionChoice['ref'],
                'typeformId' => $formQuestionChoice['id']
            ])){
                $this->create($formQuestionChoice, $question);
            }
        }
    }

    /**
     * @param array    $formQuestionChoice
     * @param Question $question
     */
    private function create(array $formQuestionChoice, Question $question)
    {
        $this->em->persist((new QuestionChoice())
            ->setTypeformId($formQuestionChoice['id'])
            ->setTypeformRef($formQuestionChoice['ref'])
            ->setLabel($formQuestionChoice['label'])
            ->setQuestion($question));

        $this->em->flush();
    }
}
