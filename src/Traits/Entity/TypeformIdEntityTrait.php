<?php

namespace App\Traits\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
trait TypeformIdEntityTrait
{
    /**
     * @ORM\Column(type="string", name="typeform_id")
     */
    private string $typeformId;

    public function getTypeformId(): string
    {
        return $this->typeformId;
    }

    public function setTypeformId(string $typeformId): self
    {
        $this->typeformId = $typeformId;

        return $this;
    }
}
