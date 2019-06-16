<?php

namespace App\Traits\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
trait TypeformRefEntityTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", name="typeform_ref")
     */
    private $typeformRef;

    /**
     * @return string
     */
    public function getTypeformRef(): string
    {
        return $this->typeformRef;
    }

    /**
     * @param string $typeformRef
     *
     * @return self
     */
    public function setTypeformRef(string $typeformRef): self
    {
        $this->typeformRef = $typeformRef;

        return $this;
    }
}
