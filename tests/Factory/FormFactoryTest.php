<?php

namespace App\Tests\Factory;

use App\Dto\DefinitionDto;
use App\Dto\FormResponseDto;
use App\Entity\Form;
use App\Factory\FormFactory;
use PHPUnit\Framework\TestCase;

class FormFactoryTest extends TestCase
{
    public function testCreateFormSuccess(): void
    {
        $definitionDto = new DefinitionDto();
        $definitionDto->id = 'typeformId';
        $definitionDto->title = 'typeformTitle';

        $formResponseDto = new FormResponseDto();
        $formResponseDto->definition = $definitionDto;

        $form = FormFactory::create($formResponseDto);

        $this->assertEquals($definitionDto->title, $form->getName());
        $this->assertEquals($definitionDto->id, $form->getTypeformId());
        $this->assertInstanceOf(Form::class, $form);
    }
}
