<?php

namespace IAppBundle\Doctrine;

use FOS\UserBundle\Doctrine\UserManager as FOSDoctrineUserManager;


class UserManager extends FOSDoctrineUserManager
{
    /**
     * @inheritdoc
     */
    public function findUserByUsernameOrEmail($usernameOrEmail)
    {
        return parent::findUserByEmail($usernameOrEmail);
    }

}
