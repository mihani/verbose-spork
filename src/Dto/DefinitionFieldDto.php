<?php

namespace App\Dto;

class DefinitionFieldDto
{
    public string $id;

    public string $title;

    public string $type;

    public string $ref;

    public ?bool $allowOtherChoice;

    public ?array $choices;

    public function __construct(
        string $id,
        string $title,
        string $type,
        string $ref,
        ?bool $allowOtherChoice = null,
        ?array $choices = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->type = $type;
        $this->ref = $ref;
        $this->allowOtherChoice = $allowOtherChoice;
        $this->choices = $choices;
    }
}
