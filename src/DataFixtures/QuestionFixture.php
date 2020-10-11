<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
class QuestionFixture extends Fixture implements DependentFixtureInterface
{
    public const FIRST_MULTICHOICE_QUESTION_FIXTURE_REFERENCE = 'first-question-multichoice-fixture';
    public const FIRST_SHORT_QUESTION_FIXTURE_REFERENCE = 'first-short-question-fixture';

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $objectManager): void
    {
        foreach ($this->getData() as $datum) {
            $question = (new Question())
                ->setLabel($datum['label'])
                ->setTypeformId($datum['id'])
                ->setType($datum['type'])
                ->setForm($datum['form'])
                ->setAllowOtherChoice($datum['allowMultiChoice'])
                ->setTypeformRef($datum['ref'])
            ;
            $objectManager->persist($question);

            if (null !== $datum['fixtureReference']) {
                $this->addReference($datum['fixtureReference'], $question);
            }
        }

        $objectManager->flush();
    }

    public function getDependencies(): array
    {
        return [
            FormFixture::class,
        ];
    }

    private function getData(): array
    {
        return [
            // First Form Question
            [
                'label' => $this->faker->words(3, true),
                'form' => $this->getReference(FormFixture::FIRST_FORM_FOR_QUESTION_FIXTURE_REFERENCE),
                'type' => Question::SHORT_TEXT_CHOICE_TYPE,
                'ref' => 'questionTypeformRefForQuestionManagerUnitTestQuestionOne',
                'id' => 'questionTypeformIdForQuestionManagerUnitTestQuestionOne',
                'allowMultiChoice' => false,
                'fixtureReference' => self::FIRST_SHORT_QUESTION_FIXTURE_REFERENCE,
            ],
            [
                'label' => $this->faker->words(3, true),
                'form' => $this->getReference(FormFixture::FIRST_FORM_FOR_QUESTION_FIXTURE_REFERENCE),
                'type' => Question::BOOL_CHOICE_TYPE,
                'ref' => 'questionTypeformRefForQuestionManagerUnitTestQuestionTwo',
                'id' => 'questionTypeformIdForQuestionManagerUnitTestQuestionTwo',
                'allowMultiChoice' => false,
                'fixtureReference' => null,
            ],
            [
                'label' => $this->faker->words(3, true),
                'form' => $this->getReference(FormFixture::FIRST_FORM_FOR_QUESTION_FIXTURE_REFERENCE),
                'type' => Question::LONG_TEXT_CHOICE_TYPE,
                'ref' => 'questionTypeformRefForQuestionManagerUnitTestQuestionThree',
                'id' => 'questionTypeformIdForQuestionManagerUnitTestQuestionThree',
                'allowMultiChoice' => false,
                'fixtureReference' => null,
            ],
            [
                'label' => $this->faker->words(3, true),
                'form' => $this->getReference(FormFixture::FIRST_FORM_FOR_QUESTION_FIXTURE_REFERENCE),
                'type' => Question::MULTIPLE_CHOICE_TYPE,
                'ref' => 'questionTypeformRefForQuestionManagerUnitTestQuestionMultichoiceOne',
                'id' => 'questionTypeformIdForQuestionManagerUnitTestQuestionMultichoiceOne',
                'allowMultiChoice' => true,
                'fixtureReference' => self::FIRST_MULTICHOICE_QUESTION_FIXTURE_REFERENCE,
            ],
        ];
    }
}
