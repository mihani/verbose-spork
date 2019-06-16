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
     * @param EntityManagerInterface $em
     */
    public function setEntityManager(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
