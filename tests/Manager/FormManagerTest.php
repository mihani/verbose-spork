<?php

namespace App\Tests\Manager;

use App\Entity\Form;
use App\Manager\FormManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class FormManagerTest extends TestCase
{
    private Generator $faker;

    public function __construct()
    {
        parent::__construct();
        $this->faker = Factory::create();
    }

    public function testCreateFormSuccess(): void
    {
        $formData = [
            'definition' => [
                'id' => 'typeformIdUsedInFormManagerUnitTest',
            ],
        ];

        $form = (new Form())
            ->setTypeformId($formData['definition']['id'])
            ->setName($this->faker->word(3, true))
        ;

        $mockedRepo = $this->createMock(EntityRepository::class);
        $mockedRepo->expects($this->any())->method('findOneBy')->withAnyParameters()->willReturn($form);

        $mockedEm = $this->createMock(EntityManager::class);
        $mockedEm->expects($this->any())->method('getRepository')->withAnyParameters()->willReturn($mockedRepo);

        $formManager = new FormManager();
        $formManager->setEntityManager($mockedEm);

        $existingForm = $formManager->createForm($formData['definition']);
        $this->assertEquals($form, $existingForm);
    }
}
