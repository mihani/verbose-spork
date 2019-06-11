<?php

namespace App\Traits;

use Doctrine\ORM\EntityManagerInterface;

trait EntityManagerInterfaceTrait
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * @required
     */
    public function setEntityManager(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

}
