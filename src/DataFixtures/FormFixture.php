<?php

namespace App\DataFixtures;

use App\Entity\Form;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
class FormFixture extends Fixture
{
    public const FIRST_FORM_FOR_QUESTION_FIXTURE_REFERENCE = 'first-form-question-fixture';

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $objectManager): void
    {
        foreach ($this->getData() as $datum) {
            $form = (new Form())
                ->setName($datum['title'])
                ->setTypeformId($datum['typeformId'])
                ->setCreatedAt(new \DateTime('2018-01-01'))
            ;

            $objectManager->persist($form);

            if (null !== $datum['fixtureReference']) {
                $this->addReference($datum['fixtureReference'], $form);
            }
        }

        $objectManager->flush();
    }

    private function getData(): array
    {
        return [
            [
                'title' => $this->faker->words(3, true),
                'typeformId' => 'typeformIdUsedInFormManagerUnitTest',
                'fixtureReference' => null,
            ],
            [
                'title' => $this->faker->words(3, true),
                'typeformId' => 'typeformIdUsedInQuestionManagerUnitTest',
                'fixtureReference' => self::FIRST_FORM_FOR_QUESTION_FIXTURE_REFERENCE,
            ],
        ];
    }
}
