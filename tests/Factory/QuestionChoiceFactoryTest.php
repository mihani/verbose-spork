<?php

namespace App\Tests\Factory;

use App\Dto\AnswerDto;
use App\Dto\DefinitionDto;
use App\Dto\DefinitionFieldDto;
use App\Dto\FieldDto;
use App\Entity\Answer;
use App\Entity\Form;
use App\Entity\Question;
use App\Entity\QuestionChoice;
use App\Factory\AnswerFactory;
use App\Factory\QuestionChoiceFactory;
use App\Factory\QuestionFactory;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class QuestionChoiceFactoryTest extends TestCase
{
    public function testCreateQuestionChoiceSuccess(): void
    {
        $question = (new Question())
            ->setTypeformId('fieldId')
            ->setTypeformRef('e43cf3f75acfbd8d')
            ->setType('multiple_choice')
            ->setLabel("Comment m'avez vous trouvé ?");

        $choice = [
            "id" => "fhizCwkjNr8g",
            "label" => "Linkedin"
        ];

        $questionChoice = QuestionChoiceFactory::create($choice, $question);

        $this->assertEquals($choice['label'], $questionChoice->getLabel());
        $this->assertEquals($choice['id'], $questionChoice->getTypeformId());
        $this->assertEquals($question, $questionChoice->getQuestion());
    }
}
