<?php

namespace App\Factory;

use App\Dto\FormResponseDto;
use App\Entity\Form;

class FormFactory
{
    public static function create(FormResponseDto $formResponseDto): Form
    {
        $definition = $formResponseDto->definition;

        return (new Form())
            ->setName($definition->title)
            ->setTypeformId($definition->id)
        ;
    }
}
