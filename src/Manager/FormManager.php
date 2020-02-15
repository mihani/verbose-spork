<?php

namespace App\Manager;

use App\Entity\Form;
use App\Traits\EntityManagerInterfaceTrait;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
class FormManager
{
    use EntityManagerInterfaceTrait;

    public function createForm(array $formResponse): Form
    {
        /** @var Form $form */
        if ($form = $this->em->getRepository(Form::class)->findOneBy(['typeformId' => $formResponse['id']])) {
            return $form;
        }

        return $this->create($formResponse);
    }

    private function create(array $formDefinition): Form
    {
        $form = (new Form())
            ->setName($formDefinition['title'])
            ->setTypeformId($formDefinition['id'])
        ;

        $this->em->persist($form);
        $this->em->flush();

        return $form;
    }
}
