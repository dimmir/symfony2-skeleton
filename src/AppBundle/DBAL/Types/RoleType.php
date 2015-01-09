<?php

namespace AppBundle\DBAL\Types;

use Fresh\Bundle\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class RoleType extends AbstractEnumType
{
    const ROLE_DEFAULT      = 'ROLE_USER';
    const ROLE_SUPER_ADMIN  = 'ROLE_SUPER_ADMIN';

    /**
     * @var array Readable choices
     * @static
     */
    protected static $choices = [
        self::ROLE_DEFAULT      => 'User',
        self::ROLE_SUPER_ADMIN  => 'Super administrator',
    ];
}