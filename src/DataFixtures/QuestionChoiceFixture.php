<?php

namespace App\DataFixtures;

use App\Entity\QuestionChoice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
class QuestionChoiceFixture extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $objectManager): void
    {
        foreach ($this->getData() as $datum) {
            $questionChoice = (new QuestionChoice())
                ->setLabel($datum['label'])
                ->setTypeformId($datum['id'])
                ->setQuestion($datum['question'])
            ;
            $objectManager->persist($questionChoice);
        }

        $objectManager->flush();
    }

    public function getDependencies(): array
    {
        return [
            QuestionFixture::class,
        ];
    }

    private function getData(): array
    {
        return [
            [
                'id' => 'typeformIdFirstQuestionChoiceUsedInUnitTest',
                'label' => $this->faker->word(),
                'question' => $this->getReference(QuestionFixture::FIRST_MULTICHOICE_QUESTION_FIXTURE_REFERENCE),
            ],
            [
                'id' => $this->faker->uuid,
                'label' => $this->faker->word(),
                'question' => $this->getReference(QuestionFixture::FIRST_MULTICHOICE_QUESTION_FIXTURE_REFERENCE),
            ],
            [
                'id' => $this->faker->uuid,
                'label' => $this->faker->word(),
                'question' => $this->getReference(QuestionFixture::FIRST_MULTICHOICE_QUESTION_FIXTURE_REFERENCE),
            ],
        ];
    }
}
