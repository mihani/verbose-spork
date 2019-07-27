<?php

namespace App\Manager;

use App\Entity\Form;
use App\Traits\EntityManagerInterfaceTrait;

class FormManager
{
    use EntityManagerInterfaceTrait;

    /**
     * @param array $formResponse
     *
     * @return Form
     */
    public function createForm(array $formResponse): Form
    {
        /** @var Form $form */
        if ($form = $this->em->getRepository(Form::class)->findOneBy(['typeformId' => $formResponse['id']])) {
            return $form;
        }

        return $this->create($formResponse);
    }

    /**
     * @param array $formDefinition
     *
     * @return Form
     */
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
