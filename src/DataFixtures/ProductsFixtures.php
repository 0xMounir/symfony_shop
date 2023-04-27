<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i <= 10; $i++) {
            $product = new Products();
            $product
                ->setName($faker->word())
                ->setDescription($faker->sentence())
                ->setPriceHt($faker->randomNumber(3))
                ->setVisible($faker->boolean(80))
                ->setDiscount($faker->boolean(80))
                ->setCategoryId(
                    $this->getReference(
                        CategorysFixtures::CATEGORY_PREFIX . $faker->numberBetween(1, CategorysFixtures::NB_CATEGORIES)
                    )
                );

            $manager->persist($product);
        }

        $manager->flush();
    }
}
