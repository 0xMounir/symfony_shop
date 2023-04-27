<?php

namespace App\DataFixtures;

use App\Entity\Categorys;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategorysFixtures extends Fixture
{
    public const NB_CATEGORIES = 5;
    public const CATEGORY_PREFIX = 'CATEGORY_';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < self::NB_CATEGORIES; $i++) {
            $category = new Categorys();
            $category->setName($faker->word);

            $this->addReference(self::CATEGORY_PREFIX . $i, $category);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
