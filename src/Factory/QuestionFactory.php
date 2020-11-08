<?php

namespace App\Factory;

use App\Dto\DefinitionFieldDto;
use App\Entity\Form;
use App\Entity\Question;

class QuestionFactory
{
    public static function create(DefinitionFieldDto $definitionFieldDto, Form $form): Question
    {
        $question = (new Question())
            ->setLabel($definitionFieldDto->title)
            ->setForm($form)
            ->setType($definitionFieldDto->type)
            ->setTypeformId($definitionFieldDto->id)
            ->setTypeformRef($definitionFieldDto->ref)
        ;

        if (Question::MULTIPLE_CHOICE_TYPE === $definitionFieldDto->type) {
            $question->setAllowOtherChoice((bool) $definitionFieldDto->allowOtherChoice);

            foreach ($definitionFieldDto->choices as $choice) {
                $questionChoice = QuestionChoiceFactory::create($choice, $question);
                $question->addQuestionChoice($questionChoice);
            }
        }

        return $question;
    }
}
