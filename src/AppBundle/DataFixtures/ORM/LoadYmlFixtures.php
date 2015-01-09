<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Inflector\Inflector;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\Yaml\Yaml;


class LoadYmlFixture extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @inheritdoc
     */
    public function load(ObjectManager $em)
    {
        $directory = dirname(__FILE__) . '/Fixtures';
        $files = glob($directory . '/*.yml');

        foreach ($files as $file) {
            $fixtureData = Yaml::parse($file);
            $class = $fixtureData['model'];
            $fixtures = $fixtureData['fixtures'];

            foreach ($fixtures as $alias => $data) {
                $entity = new $class();
                foreach ($data as $field => $value) {
                    $method = Inflector::camelize('set_' . $field);
                    $entity->$method($value);
                }

                $em->persist($entity);
                $this->setReference($alias, $entity);
            }
        }

        $em->flush();
    }

    /**
     * @inheritdoc
     */
    public function getOrder()
    {
        return 1;
    }
}