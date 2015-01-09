<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

use AppBundle\Entity\User;
use AppBundle\DBAL\Types\RoleType;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @inheritdoc
     */
    public function load(ObjectManager $em)
    {
        // super administrator
        $user = new User();

        $user
            ->setFirstName('User')
            ->setLastName('Userovich')
            ->setPlainPassword('123')
            ->setEmail('user@mail.com')
            ->setRole(RoleType::ROLE_SUPER_ADMIN)

            ->setEnabled(true);

        $em->persist($user);

        //users
        $count = rand(20, 30);
        $roles = array_keys(RoleType::getChoices());

        array_pop($roles);

        for ($i = 1; $i < $count; $i++) {
            $role     = $roles[array_rand($roles)];

            $user = new User();
            $user
                ->setFirstName("User {$i}")
                ->setLastName('Userovich')
                ->setPlainPassword('123')
                ->setEmail("user{$i}@mail.com")
                ->setRole($role)
                ->setEnabled(true);

            $em->persist($user);
        }

        // flush
        $em->flush();
    }

    /**
     * @inheritdoc
     */
    public function getOrder()
    {
        return 10;
    }
}
