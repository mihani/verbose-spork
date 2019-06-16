<?php

namespace App\Manager;

use App\Entity\Form;
use App\Entity\Question;
use App\Traits\EntityManagerInterfaceTrait;

class QuestionManager
{
    use EntityManagerInterfaceTrait;

    /** @var QuestionChoiceManager */
    private $questionChoiceManager;

    /**
     * @param QuestionChoiceManager $questionChoiceManager
     */
    public function __construct(QuestionChoiceManager $questionChoiceManager)
    {
        $this->questionChoiceManager = $questionChoiceManager;
    }

    public function createQuestions(array $formQuestions, Form $form)
    {
        foreach ($formQuestions as $formQuestion) {
            if (!$this->em->getRepository(Question::class)->findOneBy([
                'typeformId'=>$formQuestion['id'],
                'typeformRef' => $formQuestion['ref']])
            ){
                $this->create($formQuestion, $form);
            }
        }
    }

    /**
     * @param array $formQuestion
     * @param Form  $form
     */
    private function create(array $formQuestion, Form $form)
    {
        $question = (new Question())
            ->setLabel($formQuestion['title'])
            ->setForm($form)
            ->setType($formQuestion['type'])
            ->setTypeformRef($formQuestion['ref'])
            ->setTypeformId($formQuestion['id']);

        $this->em->persist($question);
        
        if (Question::MULTIPLE_CHOICE_TYPE === $formQuestion['type'] && $formQuestion['properties']){
            $question->setAllowOtherChoice($formQuestion['properties']['allow_other_choice']);

            $this->questionChoiceManager->createQuestionChoice($formQuestion['properties']['choices'], $question);
        }

    }
}
