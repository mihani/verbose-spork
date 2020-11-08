<?php

namespace App\Dto;

class FieldDto
{
    public string $id;

    public string $type;

    public string $ref;

    public function __construct(string $id, string $type, string $ref)
    {
        $this->id = $id;
        $this->type = $type;
        $this->ref = $ref;
    }
}
