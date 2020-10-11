<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AnswerFixture extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $objectManager)
    {
        foreach ($this->getData() as $datum) {
            $anwser = (new Answer())
                ->setQuestion($datum['question'])
                ->setContent($datum['answer'])
                ->setGroupByToken($datum['groupByToken'])
            ;

            $objectManager->persist($anwser);
        }

        $objectManager->flush();
    }

    public function getDependencies()
    {
        return[
            QuestionFixture::class,
        ];
    }

    private function getData(): array
    {
        $groupByToken = $this->faker->uuid;

        return [
            [
                'answer' => $this->faker->word(),
                'question' => $this->getReference(QuestionFixture::FIRST_SHORT_QUESTION_FIXTURE_REFERENCE),
                'groupByToken' => $groupByToken,
            ],
            [
                'answer' => $this->faker->word(),
                'question' => $this->getReference(QuestionFixture::FIRST_MULTICHOICE_QUESTION_FIXTURE_REFERENCE),
                'groupByToken' => $groupByToken,
            ],
        ];
    }
}
