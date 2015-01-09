<?php


namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findByEmailWithoutFilter($email)
    {
        if (array_key_exists('softdeleteable', $this->_em->getFilters()->getEnabledFilters())) {
            $this->_em->getFilters()->disable('softdeleteable');
        }

        return $this->findByEmail($email);
    }
}