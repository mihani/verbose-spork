<?php

namespace App\Dto;

class FormResponseDto
{
    public string $formId;

    public string $token;

    public \DateTime $landedAt;

    public \DateTime $submittedAt;

    public DefinitionDto $definition;

    public array $answers;
}
