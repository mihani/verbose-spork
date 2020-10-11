<?php

namespace App\Manager;

use App\Entity\Form;
use App\Entity\Question;
use App\Traits\EntityManagerInterfaceTrait;

class QuestionManager
{
    use EntityManagerInterfaceTrait;

    private QuestionChoiceManager $questionChoiceManager;

    public function __construct(QuestionChoiceManager $questionChoiceManager)
    {
        $this->questionChoiceManager = $questionChoiceManager;
    }

    public function createQuestions(array $formQuestions, Form $form): void
    {
        foreach ($formQuestions as $formQuestion) {
            if ($this->em->getRepository(Question::class)->findOneBy([
                'typeformId' => $formQuestion['id'],
                'typeformRef' => $formQuestion['ref'],
            ])) {
                continue;
            }

            $this->create($formQuestion, $form);
        }
    }

    private function create(array $formQuestion, Form $form): void
    {
        $question = (new Question())
            ->setLabel($formQuestion['title'])
            ->setForm($form)
            ->setType($formQuestion['type'])
            ->setTypeformRef($formQuestion['ref'])
            ->setTypeformId($formQuestion['id'])
        ;

        $this->em->persist($question);

        if (Question::MULTIPLE_CHOICE_TYPE === $formQuestion['type']) {
            $question->setAllowOtherChoice((bool) $formQuestion['allow_other_choice']);

            $this->questionChoiceManager->createQuestionChoice($formQuestion['choices'], $question);
        }

        $this->em->flush();
    }
}
