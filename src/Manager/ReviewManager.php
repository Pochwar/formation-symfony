<?php

namespace App\Manager;

use Symfony\Bridge\Doctrine\RegistryInterface;

class ReviewManager implements ReviewManagerInterface
{
    /**
     * @var RegistryInterface
     */
    private $doctrine;

    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function manage($review) {
        $this->doctrine->getManager()->persist($review);
        $this->doctrine->getManager()->flush();
    }
}
