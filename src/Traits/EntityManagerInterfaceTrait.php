<?php

namespace App\Traits;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
trait EntityManagerInterfaceTrait
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * @required
     *          
     * @param EntityManagerInterface $em
     */
    public function setEntityManager(EntityManagerInterface $em): void
    {
        $this->em = $em;
    }
}
