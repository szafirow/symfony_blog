<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 2018-02-10
 * Time: 12:20
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


/**
 * Description of LoadPostData
 *
 */
class LoadPostData extends Fixture implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     */
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 1000; $i++) {

            $post = new \AppBundle\Entity\Post();
            $post->setTitle($faker->sentence(3));
            $post->setLead($faker->text(300));
            $post->setContent($faker->text(700));
            $post->setCreatedAt($faker->dateTimeThisMonth);

            $manager->persist($post);
        }

        $manager->flush();
    }
}