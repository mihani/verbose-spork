<?php

namespace App\Manager;

use App\Entity\Form;
use App\Entity\Question;
use Doctrine\ORM\EntityManagerInterface;

class QuestionManager
{
    private QuestionChoiceManager $questionChoiceManager;

    private EntityManagerInterface $em;

    public function __construct(QuestionChoiceManager $questionChoiceManager, EntityManagerInterface $em)
    {
        $this->questionChoiceManager = $questionChoiceManager;
        $this->em = $em;
    }

    public function createQuestions(array $formQuestions, Form $form): void
    {
        foreach ($formQuestions as $formQuestion) {
            if ($this->em->getRepository(Question::class)->findOneBy([
                'typeformId' => $formQuestion['id'],
                'typeformRef' => $formQuestion['ref'], ])
            ) {
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
            $question->setAllowOtherChoice((bool) $formQuestion['properties']['allow_other_choice']);

            $this->questionChoiceManager->createQuestionChoice($formQuestion['properties']['choices'], $question);
        }

        $this->em->flush();
    }
}
