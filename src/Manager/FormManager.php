<?php

namespace App\Manager;

use App\Entity\Form;
use App\Repository\FormRepository;
use App\Traits\EntityManagerInterfaceTrait;

class FormManager
{
    use EntityManagerInterfaceTrait;

    /**
     * @param array $formResponse
     *
     * @return Form|object|null
     */
    public function createForm(array $formResponse)
    {
        /** @var FormRepository $formRepository */
        $formRepository = $this->em->getRepository(Form::class);

        if ($form = $formRepository->findOneBy(['typeformId' => $formResponse['definition']['id']])){
            return $form;
        }

        return $this->create($formResponse['definition']);
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
            ->setTypeformId($formDefinition['id']);

        $this->em->persist($form);
        $this->em->flush();

        return $form;
    }
}
