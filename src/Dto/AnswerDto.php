<?php

namespace App\Dto;

class AnswerDto
{
    public string $type;

    public string $value;

    public FieldDto $field;

    public function __construct(string $type, string $value, FieldDto $field)
    {
        $this->type = $type;
        $this->value = $value;
        $this->field = $field;
    }
}
