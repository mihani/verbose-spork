<?php

namespace App\Traits\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
trait TypeformIdEntityTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", name="typeform_id")
     */
    private $typeformId;

    /**
     * @return string
     */
    public function getTypeformId(): string
    {
        return $this->typeformId;
    }

    /**
     * @param string $typeformId
     *
     * @return self
     */
    public function setTypeformId(string $typeformId): self
    {
        $this->typeformId = $typeformId;

        return $this;
    }
}
