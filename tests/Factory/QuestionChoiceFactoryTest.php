<?php

namespace App\Tests\Factory;

use App\Entity\Question;
use App\Factory\QuestionChoiceFactory;
use PHPUnit\Framework\TestCase;

class QuestionChoiceFactoryTest extends TestCase
{
    public function testCreateQuestionChoiceSuccess(): void
    {
        $question = (new Question())
            ->setTypeformId('fieldId')
            ->setTypeformRef('e43cf3f75acfbd8d')
            ->setType('multiple_choice')
            ->setLabel("Comment m'avez vous trouvé ?")
        ;

        $choice = [
            'id' => 'fhizCwkjNr8g',
            'label' => 'Linkedin',
        ];

        $questionChoice = QuestionChoiceFactory::create($choice, $question);

        $this->assertEquals($choice['label'], $questionChoice->getLabel());
        $this->assertEquals($choice['id'], $questionChoice->getTypeformId());
        $this->assertEquals($question, $questionChoice->getQuestion());
    }
}
