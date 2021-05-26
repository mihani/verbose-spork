<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\Answer;
use App\Entity\FormatedAnswer;
use App\Entity\Question;
use App\Factory\FormatedAnswerFactory;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class FormatedAnswerFactoryTest extends TestCase
{
    private Generator $faker;

    public function setUp(): void
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function testCreateSuccess(): void
    {
        $name = $this->faker->name();
        $email = $this->faker->freeEmail();
        $companyDescription = $this->faker->paragraph();
        $contactReason = $this->faker->paragraph(2);
        $cooptation = true;
        $receivedAt = new \DateTime();

        $groupByToken = Uuid::uuid4()->toString();

        $formatedAnswer = FormatedAnswerFactory::create($groupByToken, $name, $email, $companyDescription, $contactReason, $cooptation, $receivedAt);

        $this->assertInstanceOf(FormatedAnswer::class, $formatedAnswer);
        $this->assertEquals($groupByToken, $formatedAnswer->getUuid());
        $this->assertEquals($name, $formatedAnswer->getName());
        $this->assertEquals($email, $formatedAnswer->getEmail());
        $this->assertEquals($companyDescription, $formatedAnswer->getCompanyDescription());
        $this->assertEquals($contactReason, $formatedAnswer->getContactReason());
        $this->assertEquals($cooptation, $formatedAnswer->isCooptation());
        $this->assertEquals($receivedAt, $formatedAnswer->getReceivedAt());
    }

    public function testCreateFromAnswersSuccess(): void
    {
        $groupAnswerData = $this->getAnswerRawData();

        $answers = [];
        foreach ($groupAnswerData as $key => $groupAnswerDatum) {
            foreach ($groupAnswerDatum as $answerDatum) {
                $answers[] = (new Answer())
                    ->setContent((string) $answerDatum['content'])
                    ->setGroupByToken($key)
                    ->setQuestion($answerDatum['question'])
                    ->setCreatedAt($answerDatum['createdAt'])
                ;
            }

        }

        $formatedAnswerEntities = FormatedAnswerFactory::createFromAnswers($answers);

        $this->assertIsArray($formatedAnswerEntities);
        foreach ($formatedAnswerEntities as $formatedAnswerEntity) {
            $this->assertInstanceOf(FormatedAnswer::class, $formatedAnswerEntity);
        }
    }

    public function testCreateFromAnswersReturnNull(): void
    {
        $groupAnswerData = $this->getAnswerRawData();

        $formatedAnswerEntities = FormatedAnswerFactory::createFromAnswers($groupAnswerData);

        $this->assertNull($formatedAnswerEntities);
    }

    private function getAnswerRawData()
    {
        return [
            Uuid::uuid4()->toString() => [
                [
                    'content' => $this->faker->name(),
                    'question' => $this->createConfiguredMock(Question::class, ['getFormatedAnswerRole' => Question::FORMATED_ANSWER_ROLE_NAME]),
                    'createdAt' => new \DateTime(),
                ],
                [
                    'content' => $this->faker->freeEmail(),
                    'question' => $this->createConfiguredMock(Question::class, ['getFormatedAnswerRole' => Question::FORMATED_ANSWER_ROLE_EMAIL]),
                    'createdAt' => new \DateTime(),
                ],
                [
                    'content' => $this->faker->paragraph(),
                    'question' => $this->createConfiguredMock(Question::class, ['getFormatedAnswerRole' => Question::FORMATED_ANSWER_ROLE_COMPANY]),
                    'createdAt' => new \DateTime(),
                ],
                [
                    'content' => $this->faker->paragraph(),
                    'question' => $this->createConfiguredMock(Question::class, ['getFormatedAnswerRole' => Question::FORMATED_ANSWER_ROLE_REASON]),
                    'createdAt' => new \DateTime(),
                ],
                [
                    'content' => true,
                    'question' => $this->createConfiguredMock(Question::class, ['getFormatedAnswerRole' => Question::FORMATED_ANSWER_ROLE_COOPTATION]),
                    'createdAt' => new \DateTime(),
                ],
            ],
            Uuid::uuid4()->toString() => [
                [
                    'content' => $this->faker->name(),
                    'question' => $this->createConfiguredMock(Question::class, ['getFormatedAnswerRole' => Question::FORMATED_ANSWER_ROLE_NAME]),
                    'createdAt' => new \DateTime(),
                ],
                [
                    'content' => $this->faker->freeEmail(),
                    'question' => $this->createConfiguredMock(Question::class, ['getFormatedAnswerRole' => Question::FORMATED_ANSWER_ROLE_EMAIL]),
                    'createdAt' => new \DateTime(),
                ],
                [
                    'content' => $this->faker->paragraph(),
                    'question' => $this->createConfiguredMock(Question::class, ['getFormatedAnswerRole' => Question::FORMATED_ANSWER_ROLE_COMPANY]),
                    'createdAt' => new \DateTime(),
                ],
                [
                    'content' => $this->faker->paragraph(),
                    'question' => $this->createConfiguredMock(Question::class, ['getFormatedAnswerRole' => Question::FORMATED_ANSWER_ROLE_REASON]),
                    'createdAt' => new \DateTime(),
                ],
                [
                    'content' => false,
                    'question' => $this->createConfiguredMock(Question::class, ['getFormatedAnswerRole' => Question::FORMATED_ANSWER_ROLE_COOPTATION]),
                    'createdAt' => new \DateTime(),
                ],
            ],
        ];
    }
}
