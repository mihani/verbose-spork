<?php

namespace App\Traits;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
trait EntityManagerInterfaceTrait
{
    private EntityManagerInterface $em;

    /**
     * @required
     */
    public function setEntityManager(EntityManagerInterface $em): void
    {
        $this->em = $em;
    }
}
