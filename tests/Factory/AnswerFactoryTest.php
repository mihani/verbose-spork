<?php

namespace App\Tests\Factory;

use App\Dto\AnswerDto;
use App\Dto\FieldDto;
use App\Entity\Answer;
use App\Entity\Question;
use App\Factory\AnswerFactory;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class AnswerFactoryTest extends TestCase
{
    public function testCreateAnswerSuccess(): void
    {
        $fieldDto = new FieldDto('fieldId','short_text', '62887e4e6983de5a');

        $answerDto = new AnswerDto('text', 'answerSucces', $fieldDto);

        $question = (new Question())
            ->setTypeformId('fieldId')
            ->setTypeformRef('62887e4e6983de5a')
            ->setType('short_text')
            ->setLabel('Quel est votre nom complet ?');

        $answer = AnswerFactory::create($answerDto, $question, Uuid::uuid4());

        $this->assertEquals($answerDto->value, $answer->getContent());
        $this->assertInstanceOf(Answer::class, $answer);
    }
}
