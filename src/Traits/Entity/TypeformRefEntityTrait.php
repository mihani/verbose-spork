<?php

namespace App\Traits\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
trait TypeformRefEntityTrait
{
    /**
     * @ORM\Column(type="string", name="typeform_ref")
     */
    private string $typeformRef;

    public function getTypeformRef(): string
    {
        return $this->typeformRef;
    }

    public function setTypeformRef(string $typeformRef): self
    {
        $this->typeformRef = $typeformRef;

        return $this;
    }
}
